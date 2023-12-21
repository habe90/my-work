<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostServicesRequestController extends Controller
{
    public function index($categoryId)
    {
        return view('frontend.services-request', ['categoryId' => $categoryId]);
    }

}
