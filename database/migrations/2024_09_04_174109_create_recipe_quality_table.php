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
        Schema::create('recipe_quality', function (Blueprint $table) {
            $table->foreignUuid('recipe_id')->cascadeOnDelete();
            $table->foreignUuid('quality_id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipe_quality', function (Blueprint $table): void {
            $table->dropForeign(['recipe_id']);
            $table->dropForeign(['quality_id']);
        });
        Schema::dropIfExists('recipe_quality');
    }
};
