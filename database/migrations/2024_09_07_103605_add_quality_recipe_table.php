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
        Schema::create('quality_recipe', function (Blueprint $table) {
            $table->foreignUuid('recipe_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('quality_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quality_recipe', function (Blueprint $table): void {
            $table->dropForeign(['recipe_id']);
            $table->dropForeign(['quality_id']);
        });
        Schema::dropIfExists('quality_recipe');
    }
};
