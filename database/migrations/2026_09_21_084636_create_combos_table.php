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
        Schema::create('combos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('combos', function (Blueprint $table) {
    $table->id();

    $table->string('name');
    $table->string('slug')->unique();

    $table->text('description')->nullable();

    $table->string('image')->nullable();

    $table->decimal('price', 12, 2)->default(0);

    $table->decimal('original_price', 12, 2)->nullable();

    $table->date('start_date')->nullable();
    $table->date('end_date')->nullable();

    $table->boolean('status')->default(true);

    $table->integer('sort_order')->default(0);

    $table->timestamps();
});
    }
};
