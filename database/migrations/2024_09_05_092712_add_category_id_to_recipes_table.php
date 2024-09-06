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
            $table->foreignUuid('category_id')->after('user_id')->nullable()
                ->constrained('recipe_category', 'category_id')->nullOnDelete();
            $table->foreignUuid('quality_id')->after('category_id')->nullable()
                ->constrained('recipe_quality', 'quality_id')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropForeign('quality_id');
            $table->dropColumn('quality_id');
            $table->dropForeign('category_id');
            $table->dropColumn('category_id');
        });
    }
};
