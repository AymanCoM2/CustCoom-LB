<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('path')->nullable();
            $table->unsignedBigInteger('customer_id'); // To Make a Real One First 
            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->boolean('isApproved')->default(false);
            $table->string('mimeType')->default('pdf');
            $table->unsignedInteger('uploaded_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
