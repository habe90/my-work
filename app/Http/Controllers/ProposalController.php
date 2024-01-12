<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;

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
    
        //create new offer
        $proposal = new Bid();
        $proposal->job_id = $validatedData['job_id'];
        $proposal->user_id = $validatedData['user_id'];
        $proposal->amount = $validatedData['amount'];
        $proposal->comment = $validatedData['comment'] ?? null; 
        $proposal->save();
    
        // Redirect
        return redirect()->back()->with('success', 'Your offer has been successfully sent!');
    }


    
}
