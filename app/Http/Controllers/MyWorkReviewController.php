<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyWorkReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.my-work-reviews.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $review = new MyWorkReview($request->except('image'));
    
        $review->save();
    
        if ($request->hasFile('image')) {
            // Use Spatie media library to add the image
            $review->addMediaFromRequest('image')
                   ->toMediaCollection('reviews');
    
            // Save the image path in the database
            $review->image_path = $review->getFirstMedia('reviews')->getUrl();
            $review->save();
        }
    
        return back()->with('success', 'Review has been added successfully.');
    }
    


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
