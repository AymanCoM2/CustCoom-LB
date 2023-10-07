<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('temp_disapproves', function (Blueprint $table) {
            $table->id();
            $table->string('cardCode')->nullable(); // The Edited Profile
            $table->string('editor_id')->nullable();
            $table->string('fieldName')->nullable(); //Edited Field name
            $table->string('oldValue')->nullable();
            $table->string('newValue')->nullable();
            $table->boolean('isApproved')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('temp_disapproves');
    }
};
