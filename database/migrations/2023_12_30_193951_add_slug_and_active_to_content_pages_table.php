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
        Schema::table('content_pages', function (Blueprint $table) {
            $table->string('slug')->unique()->after('title'); // Dodajte slug nakon kolone title
            $table->boolean('active')->default(false)->after('slug'); // Dodajte active nakon kolone slug
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('content_pages', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('active');
        });
    }
};
