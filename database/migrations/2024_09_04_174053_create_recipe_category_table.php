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
        Schema::create('recipe_category', function (Blueprint $table) {
            $table->foreignUuid('recipe_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignUuid('category_id')->index()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipe_category', function (Blueprint $table): void {
            $table->dropForeign(['recipe_id']);
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('recipe_category');
    }
};
