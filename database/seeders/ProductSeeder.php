<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => Str::random(10),
            'description' => Str::random(20),
            'category_id' => 1,
            'discount' => 0,
            'old_price' => 150000,
            'new_price' => 150000,
            'thumbnail' => Str::random(15) . '.jpg'
        ]);
    }
}
