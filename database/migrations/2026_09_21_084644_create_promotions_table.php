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
        Schema::create('promotions', function (Blueprint $table) {
    $table->id();

    $table->string('title');
    $table->string('slug')->unique();

    $table->string('short_description')->nullable();

    $table->longText('description')->nullable();

    $table->string('image')->nullable();

    $table->date('start_date')->nullable();
    $table->date('end_date')->nullable();

    $table->boolean('status')->default(true);

    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
