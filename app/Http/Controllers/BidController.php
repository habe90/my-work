<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Bid;

class BidController extends Controller
{
    public function index()
    {
 
        // i da 'auth()->id()' vraća ID trenutno autentificiranog korisnika
        $userBids = Bid::where('user_id', auth()->id())
            ->with('job') 
            ->paginate(6); 

        return view('frontend.bids.index', compact('userBids'));
    }

    public function show($jobId)
    {
        $job = Job::with('bids')->findOrFail($jobId);

        // Pretpostavimo da imate view fajl koji se zove 'bids.show'
        return view('frontend.bids.show', compact('job'));
    }
}
