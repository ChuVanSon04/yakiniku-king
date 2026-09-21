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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('banners', function (Blueprint $table) {
    $table->id();

    $table->string('title')->nullable();

    $table->enum('type', [
        'image',
        'video'
    ])->default('image');

    $table->string('image')->nullable();

    $table->string('video_url')->nullable();

    $table->string('link')->nullable();

    $table->integer('sort_order')->default(0);

    $table->boolean('status')->default(true);

    $table->timestamps();
});
    }
};
