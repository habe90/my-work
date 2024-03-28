<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    protected $fillable = ['job_id', 'user_id', 'amount', 'comment'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Ako imate povezane razgovore s ponudama
    public function conversation()
    {
        return $this->belongsTo(ImConversation::class, 'conversation_id');
    }
}
