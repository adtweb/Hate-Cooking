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
        Schema::table('recipes', function (Blueprint $table) {
            $table->foreignUuid('recipe_category_id')->constrained('recipe_category')->after('user_id')->nullOnDelete();
            $table->foreignUuid('recipe_quality_id')->constrained('recipe_quality')->after('recipe_category_id')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropForeign('recipe_quality_id');
            $table->dropColumn('recipe_quality_id');
            $table->dropForeign('recipe_category_id');
            $table->dropColumn('recipe_category_id');
        });
    }
};
