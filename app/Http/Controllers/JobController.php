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

        // $encryptedJobId = encrypt($job->id);
        //   // get send proposal form
        //   $request = new Request([
        //     'recordID' => $encryptedJobId,
        //     'formName' => encrypt('Send Proposal'),
        // ]);
        // $proposalForm = (new FormController)->loadMyForm( $request );

        
        return view('frontend.jobs.show', compact('job'));
    }
}
