<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat User Admin/Developer (Biar bisa login)
        User::create([
            'name' => 'Admin Bengkel',
            'email' => 'admin@toko.com',
            'password' => bcrypt('password'), // Passwordnya: password
        ]);

        // 2. Buat User Random (misal 5 orang lain)
        User::factory(5)->create();

        // 3. Jalankan Seeder Kategori DULUAN (Penting karena Produk butuh Kategori)
        $this->call([
            CategorySeeder::class,
        ]);

        // 4. Buat 50 Produk Dummy pakai Factory
        Product::factory(50)->create();
    }
}