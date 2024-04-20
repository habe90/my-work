<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Job;
use App\Models\User;
use App\Notifications\NewBidPlaced;
use Illuminate\Support\Facades\Notification;

class ProposalController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'comment' => 'sometimes|string',
        ]);
    
        // Provjeri da li je korisnik verifikovan
        $user = User::findOrFail($validatedData['user_id']);
        if (!$user->is_verified) {
            return redirect()->back()->with('error', __('messages.user_not_verified', [], app()->getLocale()));
        }
    
        // Kreiranje nove ponude
        $proposal = new Bid($validatedData);
        $proposal->save();
    
        // Dobavljanje vlasnika posla i slanje notifikacije
        $job = Job::findOrFail($validatedData['job_id']);
        $jobOwner = $job->user;
        Notification::send($jobOwner, new NewBidPlaced($proposal));
    
        // Preusmjeravanje sa porukom o uspjehu
        return redirect()->back()->with('success', __('messages.bid_successfully_sent', [], app()->getLocale()));
    }
    

    public function edit(Bid $proposal)
    {
        // Provjerite da li je trenutni korisnik vlasnik ponude i da li je moguće još uređivanja
        if (auth()->id() !== $proposal->user_id || $proposal->edit_count >= 3) {
            return redirect()->back()->with('error', 'Niste ovlašteni za uređivanje ove ponude ili ste premašili limit uređivanja.');
        }

        return view('proposals.edit', compact('proposal'));
    }

    public function update(Request $request, Bid $proposal)
    {
        // Provjera da li je trenutni korisnik vlasnik ponude
        if (auth()->id() !== $proposal->user_id) {
            return redirect()->back()->with('error', 'Niste ovlašteni za uređivanje ove ponude.');
        }

        // Provjera da li je broj uređivanja manji od 3
        if ($proposal->edit_count >= 3) {
            return redirect()->back()->with('error', 'Premašili ste limit uređivanja ponude.');
        }

        // Validacija zahtjeva
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'comment' => 'sometimes|string',
        ]);

        // Ažuriranje ponude
        $proposal->update($validatedData);

        // Inkrementiranje brojača uređivanja
        $proposal->increment('edit_count');

        // Preusmjeravanje na pregled ažurirane ponude sa porukom o uspjehu
        return redirect()
            ->route('proposals.show', $proposal->id)
            ->with('success', 'Ponuda je uspješno ažurirana.');
    }
}
