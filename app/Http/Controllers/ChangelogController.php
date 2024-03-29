<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangelogController extends Controller
{
    public function index(){
        
        $changelog = Changelog::all();
        return view('admin.changelog.index', compact('changelog'));

    }
}
