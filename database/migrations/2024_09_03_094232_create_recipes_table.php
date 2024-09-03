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
            $table->unsignedBigInteger('user_id')->constrained('users')->cascadeOnDelete()->index();
            $table->string('photo_url');
            $table->timestamps();
        });

        Schema::create('steps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('photo_url');
            $table->text('description');
            $table->foreignUuid('recipe_id')->constrained('recipes')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps');
        Schema::dropIfExists('recipes');
    }
};
