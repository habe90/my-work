<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class JobsController extends Controller
{
    public function index()
    {
        $jobs = Job::all(); // Dohvata sve poslove

        return view('admin.jobs.index', compact('jobs'));
    }

}
