<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\Job;
use App\Models\UserRating;
use App\Models\SuccessfulJob;
use App\Http\Controllers\Admin\FormController;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function show($encryptedJobId)
    {
        // Dekriptovanje kriptovanog ID-a posla
        $jobId = myCryptie($encryptedJobId, 'decode');

        // Pronalazak posla po dekriptovanom ID-u ili bacanje greške ako posao nije pronađen
        $job = Job::findOrFail($jobId);

        // Paginacija ponuda za posao
        $bids = $job->bids()->paginate(4);

        foreach ($bids as $bid) {
            $user = $bid->user;
            $averageRating = UserRating::where('rated_user_id', $user->id)->avg('rating');
            $user->averageRating = $averageRating;
        }

        // Provjera da li je trenutno prijavljeni korisnik već dao ponudu za posao
        $userHasMadeBid = $job->bids()->where('user_id', auth()->id())->exists();

        // Povratak na odgovarajući view sa potrebnim podacima
        return view('frontend.jobs.show', compact('job', 'bids', 'userHasMadeBid'));
    }

    public function myJobs()
    {
        // Pretpostavljamo da Job model ima metodu koja vraća poslove trenutno autentifikovanog korisnika
        $jobs = Job::where('user_id', auth()->id())->paginate(5);

        // Vraćamo view 'frontend.jobs.myjobs' i prosleđujemo mu poslove
        return view('frontend.jobs.myjobs', compact('jobs'));
    }

    public function edit(Job $job)
    {
        // Provjerite da li je korisnik vlasnik posla ili ima dozvolu za uređivanje
        if (auth()->id() !== $job->user_id) {
            // Ako korisnik nije vlasnik, preusmjerite ga sa porukom o grešci
            return redirect()->route('my-jobs')->with('error', 'Nemate dozvolu za uređivanje ovog posla.');
        }

        // Ako je sve u redu, prikažite formu za uređivanje sa podacima o poslu
        return view('frontend.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        // Provjera da li je autentificirani korisnik vlasnik posla
        if (auth()->id() !== $job->user_id) {
            return redirect()->back()->with('error', 'Sie sind nicht berechtigt, diesen Job zu bearbeiten.');
        }

        // Validacija zahtjeva
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,completed,in process,canceled',
            // Pravila za sliku i galeriju slika
            'featured_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_gallery' => 'sometimes|array',
            'image_gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ažuriranje posla
        $job->update($validator->validated());

        // Ažuriranje izdvojene slike ako je poslana
        if ($request->hasFile('featured_image')) {
            $job->clearMediaCollection('featured_images');
            $job->addMediaFromRequest('featured_image')->toMediaCollection('featured_images');

            // Postavite featured_image URL u bazi ako je potrebno
            $mediaItem = $job->getFirstMedia('featured_images');
            if ($mediaItem) {
                $job->featured_image = $mediaItem->getFullUrl();
                $job->save();
            }
        }

        // Ažuriranje galerije slika ako su poslane
        if ($request->hasFile('image_gallery')) {
            $job->clearMediaCollection('image_gallery'); // Uklonite stare slike ako je potrebno
            foreach ($request->image_gallery as $image) {
                $job->addMedia($image)->toMediaCollection('image_gallery');
            }
        }

        // Redirekcija sa porukom o uspjehu
        return redirect()->route('my-jobs')->with('success', 'Der Job wurde erfolgreich aktualisiert.');
    }

    public function destroy(Job $job)
    {
        // Ovdje osigurajte da korisnik može obrisati samo svoje poslove
        if (auth()->id() !== $job->user_id) {
            abort(403);
        }

        // Brisanje posla
        $job->delete();

        session()->flash('success', 'Der Job wurde erfolgreich gelöscht.');

        // Preusmjeravanje sa porukom o uspješnom brisanju
        return redirect()->route('my-jobs');
    }

    public function markAsCompleted($jobId)
    {
        $job = Job::with('bids')->findOrFail($jobId);
    
        // Check if the company has an active and accepted bid on this job
        $activeBid = $job->bids()->where('user_id', auth()->id())->where('status', 'accepted')->first();
    
        if (!$activeBid) {
            return redirect()->back()->with('error', 'You do not have an active or accepted bid for this job.');
        }
    
        // Update job status to 'completed'
        $job->status = 'completed';
        $job->save();
    
        // Create a record in SuccessfulJob
        $successfulJob = new SuccessfulJob([
            'bid_id' => $activeBid->id,
            'amount_due' => $activeBid->amount, // Use the amount from the bid
            'completion_date' => now(),
            'invoiced' => 0,
        ]);
        $successfulJob->save();
    
        // Redirect to the job overview with a success message
        return redirect()->back()->with('success', 'The job has been marked as completed.');
    }
    
}
