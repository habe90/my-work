<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessfulJob extends Model
{
    use HasFactory;

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    // Opcionalno, ako želite direktnu vezu sa fakturama
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
