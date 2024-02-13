<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostServicesRequestController extends Controller
{
    public function index($formId)
    {
        return view('frontend.services-request', ['formId' => $formId]);
    }

}
