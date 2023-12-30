<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentPage;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function showMenu()
    {
        $contentPages = ContentPage::where('active', 1)->get(); // pretpostavimo da imamo kolonu 'active'
        return view('frontend.index', compact('contentPages'));
    }

    public function showBySlug($slug)
    {
        $contentPage = ContentPage::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.show', compact('contentPage'));
    }


}
