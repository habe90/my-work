<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_id', 'details'];

    protected $casts = [
        'details' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function posts()
    {
        return $this->hasMany(ServicePost::class, 'service_detail_id');
    }
}
