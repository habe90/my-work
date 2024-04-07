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
}
