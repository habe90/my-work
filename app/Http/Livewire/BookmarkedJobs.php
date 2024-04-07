<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class BookmarkedJobs extends Component
{
    public $bookmarkedJobs = [];

    public function mount()
    {
        $user = Auth::user();
    
        if ($user && $user->user_type == 'company') {
            $this->bookmarkedJobs = Bookmark::with('job')
                ->where('user_id', $user->id)
                ->get(); // Uklonjeno pluck('job')->all();
        }
    }
    

    public function render()
    {
        return view('livewire.bookmarked-jobs', [
            'hasBookmarks' => !empty($this->bookmarkedJobs) // Provjera da li niz nije prazan
        ]);
    }

    public function removeBookmark($bookmarkId)
    {
        $user = Auth::user();
        
        if ($user && $user->user_type == 'company') {
            $bookmark = Bookmark::where('user_id', $user->id)->findOrFail($bookmarkId);
            $bookmark->delete();

            // Ažuriranje liste bookmarkovanih poslova nakon uklanjanja
            $this->bookmarkedJobs = $this->bookmarkedJobs->filter(function ($bookmark) use ($bookmarkId) {
                return $bookmark->id != $bookmarkId;
            });

            // Možete dodati i neku poruku o uspjehu ili osvježiti komponentu
            session()->flash('message', 'Bookmark erfolgreich entfernt.');
        }
    }

}
