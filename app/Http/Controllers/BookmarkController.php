<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function store(Request $request)
    {
        $bookmark = new Bookmark();
        $bookmark->user_id = auth()->id();
        $bookmark->job_id = $request->job_id;
        $bookmark->save();

        return response()->json(['message' => 'Posao dodan u bookmark-e.'], 200); // Vraćanje JSON odgovora
    }

    public function destroy($id)
    {
        $bookmark = Bookmark::where('job_id', $id)->where('user_id', auth()->id())->first();
        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['success' => 'Bookmark je uspješno uklonjen.']);
        }
    
        return response()->json(['error' => 'Bookmark nije pronađen.'], 404);
    }
    

    public function checkBookmark($jobId)
    {
        $isBookmarked = Bookmark::where('user_id', auth()->id())->where('job_id', $jobId)->exists();
        return response()->json(['isBookmarked' => $isBookmarked]);
    }
}
