<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $dates = ['invoice_date','due_date'];
    protected $casts = [
        'invoice_date' => 'datetime',
        'due_date' => 'datetime',
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

     // Ako želite povezati fakturu sa uspješnim poslovima
     public function successfulJobs()
     {
         return $this->hasMany(SuccessfulJob::class);
     }


     public function getStatusClassAttribute()
     {
         switch ($this->status) {
             case 'paid':
                 return 'bg-success/20 text-success';
             case 'unpaid':
                 return 'bg-warning/20 text-warning';
             case 'overdue':
                 return 'bg-danger/20 text-danger';
             default:
                 return 'bg-info/20 text-info';
         }
     }

    
}
