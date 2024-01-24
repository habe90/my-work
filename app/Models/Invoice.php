<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $dates = ['invoice_date','due_date'];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

     // Ako želite povezati fakturu sa uspješnim poslovima
     public function successfulJobs()
     {
         return $this->hasMany(SuccessfulJob::class);
     }

    
}
