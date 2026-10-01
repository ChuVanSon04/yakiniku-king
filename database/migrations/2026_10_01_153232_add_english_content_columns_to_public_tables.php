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
        Schema::table('banners', function (Blueprint $table) {
            $table->string('title_en')->nullable();
        });

        Schema::table('menu_categories', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->text('description_en')->nullable();
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->text('description_en')->nullable();
        });

        Schema::table('combos', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->text('description_en')->nullable();
        });

        Schema::table('promotions', function (Blueprint $table) {
            $table->string('title_en')->nullable();
            $table->string('short_description_en')->nullable();
            $table->longText('description_en')->nullable();
        });

        Schema::table('recipes', function (Blueprint $table) {
            $table->string('title_en')->nullable();
            $table->string('short_description_en')->nullable();
            $table->longText('content_en')->nullable();
        });

        Schema::table('tips', function (Blueprint $table) {
            $table->string('title_en')->nullable();
            $table->string('short_description_en')->nullable();
            $table->longText('content_en')->nullable();
        });

        Schema::table('kids_items', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->text('description_en')->nullable();
        });

        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('address_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'address_en']);
        });

        Schema::table('kids_items', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en']);
        });

        Schema::table('tips', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'short_description_en', 'content_en']);
        });

        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'short_description_en', 'content_en']);
        });

        Schema::table('promotions', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'short_description_en', 'description_en']);
        });

        Schema::table('combos', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en']);
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en']);
        });

        Schema::table('menu_categories', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en']);
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('title_en');
        });
    }
};
