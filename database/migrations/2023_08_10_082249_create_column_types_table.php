<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('column_types', function (Blueprint $table) {
            $table->id();
            $table->string('colName')->nullable();
            $table->string('colType')->default('string');
            // To check [ string ,ddl , number , date]
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('column_types');
    }
};
