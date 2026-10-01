<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $missingColumns = [
            'name' => ! Schema::hasColumn('kids_items', 'name'),
            'slug' => ! Schema::hasColumn('kids_items', 'slug'),
            'type' => ! Schema::hasColumn('kids_items', 'type'),
            'description' => ! Schema::hasColumn('kids_items', 'description'),
            'image' => ! Schema::hasColumn('kids_items', 'image'),
            'price' => ! Schema::hasColumn('kids_items', 'price'),
            'sort_order' => ! Schema::hasColumn('kids_items', 'sort_order'),
            'status' => ! Schema::hasColumn('kids_items', 'status'),
            'food_category' => ! Schema::hasColumn('kids_items', 'food_category'),
        ];

        Schema::table('kids_items', function (Blueprint $table) use ($missingColumns): void {
            if ($missingColumns['name']) {
                $table->string('name');
            }

            if ($missingColumns['slug']) {
                $table->string('slug')->unique();
            }

            if ($missingColumns['type']) {
                $table->string('type', 32)->default('food')->index();
            }

            if ($missingColumns['description']) {
                $table->text('description')->nullable();
            }

            if ($missingColumns['image']) {
                $table->string('image')->nullable();
            }

            if ($missingColumns['price']) {
                $table->decimal('price', 12, 2)->nullable();
            }

            if ($missingColumns['sort_order']) {
                $table->unsignedInteger('sort_order')->default(0);
            }

            if ($missingColumns['status']) {
                $table->boolean('status')->default(true);
            }

            if ($missingColumns['food_category']) {
                $table->string('food_category', 32)->nullable();
            }
        });

        if (Schema::hasColumn('menu_items', 'is_for_kids')) {
            DB::table('menu_items')
                ->where('is_for_kids', true)
                ->orderBy('id')
                ->get()
                ->each(function (object $menuItem): void {
                    $slug = $menuItem->slug ?: Str::slug($menuItem->name);
                    $baseSlug = $slug;
                    $suffix = 1;

                    while (DB::table('kids_items')->where('slug', $slug)->exists()) {
                        $slug = Str::slug($baseSlug.'-menu-'.$menuItem->id.'-'.$suffix);
                        $suffix++;
                    }

                    DB::table('kids_items')->insert([
                        'name' => $menuItem->name,
                        'slug' => $slug,
                        'type' => 'food',
                        'food_category' => null,
                        'description' => $menuItem->description,
                        'image' => $menuItem->image,
                        'price' => $menuItem->price,
                        'sort_order' => $menuItem->sort_order,
                        'status' => $menuItem->status,
                        'created_at' => $menuItem->created_at,
                        'updated_at' => $menuItem->updated_at,
                    ]);
                });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kids catalog columns may predate this migration in existing databases.
    }
};
