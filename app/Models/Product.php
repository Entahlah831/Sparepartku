<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Biar semua kolom (nama, harga, stok) bisa diisi
    protected $guarded = [];

    // Relasi: Produk masuk ke kategori apa?
    public function category() {
        return $this->belongsTo(Category::class);
    }
}