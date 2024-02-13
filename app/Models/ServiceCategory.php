<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function details()
    {
        return $this->hasMany(ServiceDetail::class, 'category_id');
    }

    public function forms()
    {
        return $this->hasMany(Forms::class, 'category_id');
    }
    
}
