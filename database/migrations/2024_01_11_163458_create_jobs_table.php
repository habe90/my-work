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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->foreignId('conversation_id')->nullable()->constrained('im_conversations')->cascadeOnDelete();
            $table->text('description');
            $table->json('additional_details')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->foreignId('service_category_id')->constrained('service_categories')->cascadeOnDelete();
            $table->boolean('is_active')->default(true);
            $table->string('featured_image')->nullable(); // Dodano za istaknutu sliku
            $table->json('image_gallery')->nullable(); // Dodano za galeriju slika kao JSON niz
            $table->timestamps();
            $table->softDeletes();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
