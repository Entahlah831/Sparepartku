<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Untuk UUID
use Midtrans\Config;
use Midtrans\Snap;

class TransactionController extends Controller
{
    public function checkoutPage()
    {
        // Ambil data keranjang untuk hitung total di halaman checkout
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        
        if($carts->isEmpty()) {
            return redirect()->route('products.index');
        }

        return view('transactions.checkout', compact('carts'));
    }

    public function store(Request $request)
{
    // 1. Validasi Input
    $request->validate([
        'address' => 'required',
        'courier' => 'required',
    ]);

    $user = Auth::user();
    $carts = Cart::where('user_id', $user->id)->get();
    
    // Hitung Total
    $totalBarang = 0;
    foreach($carts as $cart) {
        $totalBarang += ($cart->product->price * $cart->quantity);
    }
    $ongkir = 20000; 
    $grandTotal = $totalBarang + $ongkir;

    // 2. Buat Transaksi (Header)
    $transaction = Transaction::create([
        'id' => Str::uuid(),
        'user_id' => $user->id,
        'address' => $request->address,
        'courier' => $request->courier,
        'courier_service' => 'REG',
        'shipping_cost' => $ongkir,
        'total_price' => $grandTotal,
        'status' => 'unpaid',
        // snap_token masih kosong dulu
    ]);

    // 3. Pindahkan Keranjang ke Detail
    foreach($carts as $cart) {
        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'product_id' => $cart->product_id,
            'qty' => $cart->quantity,
            'price' => $cart->product->price
        ]);
    }

    // 4. Kosongkan Keranjang
    Cart::where('user_id', $user->id)->delete();

    // ==========================================
    // 5. MIDTRANS LOGIC (MULAI DARI SINI)
    // ==========================================
    
    // Set konfigurasi Midtrans
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = config('midtrans.is_sanitized');
    Config::$is3ds = config('midtrans.is_3ds');

    // Buat parameter kiriman ke Midtrans
    $params = [
        'transaction_details' => [
            'order_id' => $transaction->id, // ID Unik UUID tadi
            'gross_amount' => $grandTotal, // Total Bayar
        ],
        'customer_details' => [
            'first_name' => $user->name,
            'email' => $user->email,
            'phone' => '08123456789', // Harusnya ambil dari user profile
        ],
    ];

    // Minta Snap Token ke Midtrans
    try {
        $snapToken = Snap::getSnapToken($params);
        
        // Simpan token ke database agar tombol bayar berfungsi
        $transaction->snap_token = $snapToken;
        $transaction->save();
        
    } catch (\Exception $e) {
        // Jika gagal koneksi internet dsb
        return redirect()->back()->with('error', 'Gagal terhubung ke Midtrans: ' . $e->getMessage());
    }

    return redirect()->route('transactions.show', $transaction->id);
}

    public function show($uuid)
    {
        $transaction = Transaction::with('details.product')->findOrFail($uuid);
        return view('transactions.show', compact('transaction'));
    }
    public function index()
    {
        // Ambil data transaksi milik user yang sedang login, urutkan dari yang terbaru
        $transactions = Transaction::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('transactions.index', compact('transactions'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        
        // Verifikasi: Apakah pesan ini benar-benar dari Midtrans?
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture' || $request->transaction_status == 'settlement'){
                $transaction = Transaction::find($request->order_id);
                if($transaction){
                    $transaction->update(['status' => 'paid']);
                }
            }
        }
    }

} 

