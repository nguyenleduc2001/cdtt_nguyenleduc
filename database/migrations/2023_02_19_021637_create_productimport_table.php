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
        Schema::create('nld_productimport', function (Blueprint $table) {
            $table->id();
            $table->string('title', 1000);
            $table->string('content', 1000);
            $table->string('image',1000);
            $table->string('type');
            $table->unsignedInteger('create_by')->unique();
            $table->unsignedInteger('updated_by');
            $table->unsignedTinyInteger('status')->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nld_productimport');
    }
};