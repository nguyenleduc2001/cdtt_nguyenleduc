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
        Schema::create('nld_post', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('topic_id');
            $table->string('title', 1000);
            $table->string('slug', 1000)->nullable();
            $table->mediumText('detail');
            $table->string('image',1000);
            $table->string('type');
            $table->string('metakey',255);
            $table->string('metadesc',1000);
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
        Schema::dropIfExists('nld_post');
    }
};