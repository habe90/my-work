<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessfulJob extends Model
{
    use HasFactory;
    protected $fillable = ['bid_id', 'amount_due', 'completion_date', 'invoiced'];



    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function bid()
{
    return $this->belongsTo(Bid::class, 'bid_id'); // Pretpostavimo da je 'bid_id' strani ključ
}


    // Opcionalno, ako želite direktnu vezu sa fakturama
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
