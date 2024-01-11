<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class DashboardController extends Controller
{

    public function index()
    {
        $jobs = Job::with(['bids'])
                    ->where('user_id', auth()->id())
                    ->get();

       
        return view('frontend.dashboard.index', compact('jobs'));
    }
}
