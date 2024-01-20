<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Bid;
use App\Models\ImConversation;

class MessagesController extends Controller
{
    public function index()
    {


        return view('frontend.messages.index');
    }

    
    

}
