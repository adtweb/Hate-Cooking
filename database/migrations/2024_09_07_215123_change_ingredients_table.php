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
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropForeign('product_id');
            $table->dropForeign('measure_id');
            $table->string('measure');
        });
        Schema::dropIfExists('measures');
        Schema::dropIfExists('products');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
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

        Schema::table('ingredients', function (Blueprint $table) {
            $table->string('slug')->after('value');
            $table->float('quantity');
            $table->foreignUuid('product_id')->cascadeOnDelete();
            $table->foreignUuid('measure_id')->cascadeOnDelete();;
        });
    }
};
