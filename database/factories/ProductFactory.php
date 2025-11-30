<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category; // Jangan lupa import ini

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            // Pilih ID kategori secara acak dari yang sudah ada
            'category_id' => Category::inRandomOrder()->first()->id,

            // Karang nama produk (3 kata)
            'name' => 'Sparepart ' . $this->faker->words(2, true),

            // Slug otomatis dari name
            'slug' => $this->faker->slug(),

            // Harga antara 10rb sampai 500rb
            'price' => $this->faker->numberBetween(10000, 500000),

            // Stok antara 1 sampai 100
            'stock' => $this->faker->numberBetween(1, 100),

            // Berat antara 100 gram sampai 2kg (2000g)
            'weight' => $this->faker->numberBetween(100, 2000),

            'description' => $this->faker->paragraph(),

            // Biarkan null dulu (nanti di view pakai placeholder)
            'image' => null, 
        ];
    }
}