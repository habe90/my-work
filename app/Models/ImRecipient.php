<?php

namespace App\Models;

use App\Models\ImConversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImRecipient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['conversation_id ', 'user_id','seen_at'];

   

    public function conversation()
    {
        return $this->belongsTo(ImConversation::class, 'conversation_id');
    }

    // u ImRecipient modelu
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
