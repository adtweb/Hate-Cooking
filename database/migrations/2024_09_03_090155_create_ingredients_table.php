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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('value');
            $table->string('slug');
            $table->string('image_url');
            $table->timestamps();
        });

        Schema::create('measures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('value');
            $table->string('slug');
            $table->string('image_url');
            $table->timestamps();
        });

        Schema::create('ingredients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('value');
            $table->string('slug');
            $table->float('quantity');
            $table->foreignUuid('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignUuid('measure_id')->constrained('measures')->cascadeOnDelete();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
        Schema::dropIfExists('measures');
        Schema::dropIfExists('products');
    }
};
