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
        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete()->index();
            $table->foreignUuid('recipe_id')->constrained('recipes')->cascadeOnDelete()->index();
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table): void {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['recipe_id']);
        });
        Schema::dropIfExists('comments');
    }
};
