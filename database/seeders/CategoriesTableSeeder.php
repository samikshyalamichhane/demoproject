<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'news',
            'slug' => 'news',
            'publish' => 1,
        ]);
        Category::create([
            'name' => 'opinion',
            'slug' => 'opinion',
            'publish' => 1,
        ]);
        Category::create([
            'name' => 'images',
            'slug' => 'images',
            'publish' => 1,
        ]);
        Category::create([
            'name' => 'videos',
            'slug' => 'videos',
            'publish' => 1,
        ]);
        Category::create([
            'name' => 'press release',
            'slug' => 'press-release',
            'publish' => 1,
        ]);
    }
}
