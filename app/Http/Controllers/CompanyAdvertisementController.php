<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyAdvertisement;

class CompanyAdvertisementController extends Controller
{
    public function index()
    {
        $ads = CompanyAdvertisement::all();
        return view('admin.ads.index', compact('ads'));
    }
}
