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
        Schema::create('successful_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_id'); // Referenca na ponudu koja je prihvaćena
            $table->dateTime('completion_date'); // Datum završetka posla
            $table->decimal('amount_due', 10, 2); // Iznos duga koji firma duguje platformi
            $table->timestamps();

            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('successful_jobs');
    }
};
