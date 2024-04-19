<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('successful_jobs', function (Blueprint $table) {
            // Ako već postoji kolona 'offer_id', morate je prvo ukloniti
            $table->dropForeign(['offer_id']); 
            $table->dropColumn('offer_id'); 
            
            // Sada dodajemo 'bid_id' kolonu
            $table->unsignedBigInteger('bid_id')->after('id');
            $table->foreign('bid_id')->references('id')->on('bids')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
