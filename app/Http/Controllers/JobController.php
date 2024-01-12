<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\Job;
use App\Http\Controllers\Admin\FormController;

class JobController extends Controller
{
    public function show(Job $job)
    {
        //paginate bid
        $bids = $job->bids()->paginate(4); 

        // check if logged user already bided
        $userHasMadeBid = $job
            ->bids()
            ->where('user_id', auth()->id())
            ->exists();

        return view('frontend.jobs.show', compact('job', 'bids', 'userHasMadeBid'));
    }
}
