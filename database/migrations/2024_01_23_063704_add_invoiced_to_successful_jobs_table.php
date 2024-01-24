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
            $table->boolean('invoiced')->default(false)->after('amount_due'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('successful_jobs', function (Blueprint $table) {
            //
        });
    }
};
