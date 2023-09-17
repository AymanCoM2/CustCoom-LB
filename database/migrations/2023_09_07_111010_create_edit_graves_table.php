<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('edit_graves', function (Blueprint $table) {
            $table->id();
            $table->string('cardCode')->nullable(); // The Edited Profile
            $table->string('editor_id')->nullable();
            $table->string('fieldName')->nullable(); //Edited Field name
            $table->string('oldValue')->nullable();
            $table->string('newValue')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('edit_graves');
    }
};
