<?php

use Faker\Guesser\Name;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Normalizer\SlugNormalizer;
use Symfony\Contracts\Service\Attribute\Required;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nld_category', function (Blueprint $table) {
            $table->id();//id ,int
            $table->string('name',1000);
            $table->string('slug',1000)->nullable();
            $table->unsignedInteger('parent_id');
            $table->unsignedTinyInteger('level')->default(1);
            $table->unsignedInteger('sort_order');
            $table->string('metakey',1000);
            $table->string('metadesc',1000);
            $table->unsignedInteger('create_by')->unique();
            $table->unsignedInteger('updated_by');
            $table->unsignedTinyInteger('status')->default(2);
            $table->timestamps();//created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nld_category');
    }
};