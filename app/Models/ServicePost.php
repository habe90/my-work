<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'service_detail_id', 'title', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detail()
    {
        return $this->belongsTo(ServiceDetail::class, 'service_detail_id');
    }
}
