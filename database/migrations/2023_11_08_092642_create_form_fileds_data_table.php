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
        Schema::create('form_fileds_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('form_fields_id');
            $table->string('input_id')->nullable();
            $table->string('input_name')->nullable();
            $table->string('is_required')->nullable();
            $table->string('input_encoded')->nullable();
            $table->string('classes')->nullable();
            $table->string('input_validation')->nullable();
            $table->string('is_disabled')->nullable();
            $table->string('default_value')->nullable();
            $table->string('input_placeholder')->nullable();
            $table->string('input_style')->nullable();
            $table->string('info_text')->nullable();
            $table->text('get_info_from')->nullable();     
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('form_fields_id')->references('id')->on('form_fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_fileds_data');
    }
};
