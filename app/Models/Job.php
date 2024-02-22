<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $casts = [
        'additional_details' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function getStatusClassAttribute()
    {
        return match ($this->status) {
            'Completed' => 'bg-success/20 text-success',
            'In Process' => 'bg-info/20 text-info',
            'Cancelled' => 'bg-danger/20 text-danger',
            default => 'bg-warning/20 text-warning',
        };
    }

     /**
     * Provjerava da li je korisnik sa datim ID-jem dodao ovaj posao u bookmark-e.
     *
     * @param int $userId ID korisnika
     * @return bool
     */
    public function isBookmarkedByUser($userId)
    {
        return $this->bookmarks()->where('user_id', $userId)->exists();
    }

    // Metoda za definisanje relacije sa modelom Bookmark
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
