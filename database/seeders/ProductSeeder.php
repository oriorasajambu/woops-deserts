<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = collect(Category::all());
        for($i = 1; $i <= 40; $i++) {
            Product::create([
                'name' => 'Product '.$i,
                'slug' => 'product-'.$i,
                'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis sed accusantium vel temporibus doloribus maiores, voluptatibus voluptas nesciunt aperiam tempore, quasi earum praesentium nulla excepturi quidem ab! Distinctio, fugit aperiam?',
                'variant' => '["Keju","Coklat","Vanilla"]',
                'price' => '15000',
                'image' => 'storage/uploads/thumbnails/1703642554_yNeSKJIv8lYBAJRMa4Wuw1Cc0Wk8nR.webp',
                'original' => 'storage/uploads/originals/1703642554_yNeSKJIv8lYBAJRMa4Wuw1Cc0Wk8nR.jpg',
                'category_id' => $category->random()->id,
                'user_id' => '1',
            ]);
        }
    }
}
