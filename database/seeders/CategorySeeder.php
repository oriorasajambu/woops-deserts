<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Best Seller',
                'slug' => 'best-seller',
            ],
            [
                'name' => 'Short Cake',
                'slug' => 'short-cake',
            ],
            [
                'name' => 'Cake Jadoel',
                'slug' => 'cake-jadoel',
            ],
            [
                'name' => 'Snack Box',
                'slug' => 'snack-box',
            ],
            [
                'name' => 'Hempers',
                'slug' => 'hempers',
            ],
            [
                'name' => 'Lebaran',
                'slug' => 'lebaran',
            ],
        ];

        foreach($categories as $category) {
            Category::create($category);
        }
    }
}
