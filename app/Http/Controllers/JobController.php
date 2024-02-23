<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\Job;
use App\Models\UserRating;
use App\Http\Controllers\Admin\FormController;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function show(Job $job)
    {
        //paginate bid
        $bids = $job->bids()->paginate(4); 

        foreach ($bids as $bid) {
            $user = $bid->user;
            $averageRating = UserRating::where('rated_user_id', $user->id)->avg('rating');
            $user->averageRating = $averageRating;
        }
        // check if logged user already bided
        $userHasMadeBid = $job
            ->bids()
            ->where('user_id', auth()->id())
            ->exists();

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
        // Provjeravamo da li je autentificirani korisnik vlasnik posla
        if (auth()->id() !== $job->user_id) {
            return redirect()->back()->with('error', 'Sie sind nicht berechtigt, diesen Job zu bearbeiten.');
        }

        // Validacija podataka
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,completed,in process,canceled',
            // Dodajte pravila za ostala polja koja ažurirate
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ažuriranje posla
        $job->update($validator->validated());

        // Preusmjeravanje sa porukom o uspješnosti
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

        // Preusmjeravanje sa porukom o uspješnom brisanju
        return redirect()->route('my-jobs')->with('success', 'Posao je uspješno obrisan.');
    }



   

}
