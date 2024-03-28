<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Job;
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
            'comment' => 'sometimes|string'
        ]);
    
        // Kreiranje nove ponude
        $proposal = new Bid($validatedData);
        $proposal->save();
    
        // Dobavljanje vlasnika posla i slanje notifikacije
        $job = Job::findOrFail($validatedData['job_id']);
        $jobOwner = $job->user; // Pretpostavimo da Job model ima vezu 'user' koja vraća vlasnika posla
        Notification::send($jobOwner, new NewBidPlaced($proposal));

        // Preusmjeravanje sa porukom o uspjehu
        return redirect()->back()->with('success', 'Ihr Angebot wurde erfolgreich gesendet!');
    }
}
