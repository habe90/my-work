<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Job;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class BookmarkedJobs extends Component
{
    public $bookmarkedJobs = [];

    public function mount()
    {
        $user = Auth::user();

        if ($user && $user->type == 'company') {
            $this->bookmarkedJobs = Bookmark::with('job')
                ->where('user_id', $user->id)
                ->get()
                ->pluck('job');
        }
    }

    public function render()
    {
        return view('livewire.bookmarked-jobs', [
            'hasBookmarks' => $this->bookmarkedJobs->isNotEmpty()
        ]);
    }
}