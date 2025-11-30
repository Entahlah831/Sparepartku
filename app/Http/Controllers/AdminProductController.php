<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    // Menampilkan Form Tambah Produk
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Proses Simpan Produk ke Database
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'weight' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // 2. Upload Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Upload ke folder 'public/products'
            // Nanti filenya tersimpan di: storage/app/public/products/namafile.jpg
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // 3. Simpan Data ke Tabel Products
        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'description' => $request->description,
            'image' => $imagePath, // Simpan alamat gambarnya
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }
}