<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Pomme',
            'description' => 'Une pomme croquante et sucrée',
            'price' => 1.20,
            'image_url' => 'https://example.com/images/pomme.jpg',
            'category' => 'Fruit', //1 est l'ID de la catégorie "Fruits"
        ]);

        Product::create([
            'name' => 'Carotte',
            'description' => 'Des carottes fraîches et bio',
            'price' => 0.80,
            'image_url' => 'https://example.com/images/carotte.jpg',
            'category' => 'Légume', 
        ]);

        Product::factory()->count(10)->create();

    }
}
    

