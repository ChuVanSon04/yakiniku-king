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
        if (! Schema::hasTable('tips')) {
            return;
        }

        Schema::table('tips', function (Blueprint $table): void {
            if (! Schema::hasColumn('tips', 'title')) {
                $table->string('title')->nullable();
            }
            if (! Schema::hasColumn('tips', 'slug')) {
                $table->string('slug')->nullable()->unique();
            }
            if (! Schema::hasColumn('tips', 'short_description')) {
                $table->string('short_description')->nullable();
            }
            if (! Schema::hasColumn('tips', 'content')) {
                $table->longText('content')->nullable();
            }
            if (! Schema::hasColumn('tips', 'image')) {
                $table->string('image')->nullable();
            }
            if (! Schema::hasColumn('tips', 'status')) {
                $table->boolean('status')->default(true);
            }
            if (! Schema::hasColumn('tips', 'published_at')) {
                $table->timestamp('published_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('tips')) {
            return;
        }

        Schema::table('tips', function (Blueprint $table): void {
            $table->dropColumn([
                'title', 'slug', 'short_description', 'content',
                'image', 'status', 'published_at',
            ]);
        });
    }
};
