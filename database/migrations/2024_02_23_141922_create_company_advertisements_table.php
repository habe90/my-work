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
        Schema::create('company_advertisements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->string('logo')->nullable();
            $table->string('link');
            $table->text('offer_details')->nullable();
            $table->decimal('ad_price', 8, 2);
            $table->boolean('is_active')->default(true);
            $table->decimal('calculated_costs', 8, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_advertisements');
    }
};
