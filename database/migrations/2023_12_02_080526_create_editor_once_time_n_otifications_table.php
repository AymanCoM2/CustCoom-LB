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
        Schema::create('editor_once_time_n_otifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('editor_id');
            $table->string('field_name');
            $table->string('field_old_value');
            $table->string('field_new_value');
            $table->boolean('state'); // Approved Or Not  ; 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('editor_once_time_n_otifications');
    }
};
