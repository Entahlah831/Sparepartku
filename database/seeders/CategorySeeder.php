<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Kita buat array kategori bengkel yang umum
        $categories = ['Ban Motor', 'Oli & Pelumas', 'Kampas Rem', 'Aksesoris', 'Mesin & Karburator'];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat) // Ubah "Ban Motor" jadi "ban-motor"
            ]);
        }
    }
}
