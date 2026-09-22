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
        Schema::create('menu_items', function (Blueprint $table) {
    $table->id();

    $table->foreignId('category_id')
          ->constrained('menu_categories')
          ->cascadeOnDelete();

    $table->string('name');
    $table->string('slug')->unique();

    $table->text('description')->nullable();

    $table->string('image')->nullable();

    $table->decimal('price', 12, 2)->default(0);

    $table->boolean('is_must_try')->default(false);

    $table->boolean('is_for_kids')->default(false);

    $table->integer('sort_order')->default(0);

    $table->boolean('status')->default(true);

    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
