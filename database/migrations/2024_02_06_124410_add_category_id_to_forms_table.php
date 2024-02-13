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
        Schema::table('forms', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('data_table'); // Dodajte 'category_id' nakon kolone 'data_table'
            $table->foreign('category_id')->references('id')->on('service_categories')->onDelete('set null'); // Definisanje stranog ključa
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // Uklanjanje stranog ključa
            $table->dropColumn('category_id'); // Uklanjanje kolone 'category_id'
        });
    }
};
