<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('frontend.profile.show', compact('user'));
    }


    public function update(Request $request)
    {

        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'new_password' => 'nullable|string|min:8|confirmed',
           
        ]);

        // provjera dali validacija prolazi

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->filled('new_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Stari password nije ispravan.'])->withInput();
            }
            $user->password = Hash::make($request->new_password);
        }

        //azuriranje podataka korisnika
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->about = $request->about;
        if ($request->has('radius')) {
            $user->radius = (int) filter_var($request->radius, FILTER_SANITIZE_NUMBER_INT);
        }


        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }
        
        if ($request->hasFile('image')) {
            $media = $user->addMediaFromRequest('image')->toMediaCollection('avatars');
            $user->image = $media->getUrl(); // Postavite putanju slike u polje "image"
        }

        $user->save();


        return back()->with('success', 'Profil is updated.');

    }

}
