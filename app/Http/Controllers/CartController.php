<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Ambil keranjang milik user yang sedang login saja
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('carts.index', compact('carts'));
    }

    public function store(Request $request, $productId)
    {
        // Validasi produk valid
        $product = Product::findOrFail($productId);

        // Cek apakah barang sudah ada di keranjang user?
        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $productId)
                    ->first();

        if ($cart) {
            // Kalau ada, tambahkan jumlahnya saja
            $cart->increment('quantity', $request->quantity);
        } else {
            // Kalau belum ada, buat baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('carts.index')->with('success', 'Barang masuk keranjang!');
    }

    public function destroy($id)
    {
        Cart::findOrFail($id)->delete();
        return back();
    }
}