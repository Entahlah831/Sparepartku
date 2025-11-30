<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil semua produk, paginate 12 per halaman biar rapi
        $products = Product::latest()->paginate(12);
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        // Cari produk berdasarkan ID, kalau gak ketemu error 404
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}
