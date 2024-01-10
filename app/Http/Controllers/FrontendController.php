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
    
    $menuPages = ContentPage::whereHas('category', function ($query) {
        $query->where('name', 'Menu'); // 'name' je kolona u tabeli content_categories
    })->where('active', 1)->get();

    return view('frontend.index', compact('menuPages'));
}

    public function showBySlug($slug)
    {
        $contentPage = ContentPage::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.show', compact('contentPage'));
    }

    public function ClientLogin(){
        return view('frontend.ClientLogin.login');
    }


}
