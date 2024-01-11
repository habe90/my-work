<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class BidController extends Controller
{
    public function show($jobId)
    {
        $job = Job::with('bids')->findOrFail($jobId);
    
        // Pretpostavimo da imate view fajl koji se zove 'bids.show'
        return view('frontend.bids.show', compact('job'));
    }
}
