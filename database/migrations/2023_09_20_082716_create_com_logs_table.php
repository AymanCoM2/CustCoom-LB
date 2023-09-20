<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('com_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Editor Who is Editing  ; 
            $table->string('userCardCode')->nullable(); // The Customer Whose Data is Edited  ; 
            $table->string('field_name')->nullable();
            $table->string('entered_value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('com_logs');
    }
};
