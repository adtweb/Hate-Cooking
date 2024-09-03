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
        Schema::create('recipes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug');
            $table->string('name');
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();;
            $table->string('photo_url');
            $table->timestamps();
        });

        Schema::create('steps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('photo_url');
            $table->text('description');
            $table->foreignUuid('recipe_id')->constrained('recipes')->cascadeOnDelete();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('steps', function (Blueprint $table): void {
            $table->dropForeign(['recipe_id']);
        });
        Schema::dropIfExists('steps');
        Schema::table('recipes', function (Blueprint $table): void {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('recipes');
    }
};
