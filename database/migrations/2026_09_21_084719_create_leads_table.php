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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('leads', function (Blueprint $table) {
    $table->id();

    $table->string('name');

    $table->string('phone')->nullable();

    $table->string('email')->nullable();

    $table->text('message')->nullable();

    $table->enum('status', [
        'new',
        'read',
        'contacted'
    ])->default('new');

    $table->timestamps();
});
    }
};
