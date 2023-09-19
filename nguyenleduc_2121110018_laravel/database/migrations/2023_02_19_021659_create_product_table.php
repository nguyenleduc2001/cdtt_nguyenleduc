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
        Schema::create('pch_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('brand_id');
            $table->string('name',255);
            $table->string('slug',255);
            $table->float('price');
            $table->float('price_sale');
            $table->string('imege',1000);
            $table->unsignedInteger('qty');
            $table->mediumText('detail');
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
        Schema::dropIfExists('pch_product');
    }
};