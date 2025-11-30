<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Transaction; // Import model transaksi untuk hitung statistik

class UserController extends Controller
{
    // Menampilkan Dashboard Profil
    public function index()
    {
        $user = Auth::user();
        
        // Hitung statistik sederhana untuk ditampilkan di dashboard
        $total_transaksi = Transaction::where('user_id', $user->id)->count();
        $pending_transaksi = Transaction::where('user_id', $user->id)->where('status', 'unpaid')->count();

        return view('users.index', compact('total_transaksi', 'pending_transaksi'));
    }

    // Menampilkan Form Edit
    public function edit()
    {
        return view('users.edit');
    }

    // Proses Update Data ke Database
    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id, // Email harus unik, kecuali milik diri sendiri
            'password' => 'nullable|string|min:8|confirmed', // Confirmed artinya harus sama dengan password_confirmation
        ]);

        // 2. Update Nama & Email
        $user->name = $request->name;
        $user->email = $request->email;

        // 3. Update Password (Hanya jika diisi)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save(); // Simpan ke DB

        return redirect()->route('users.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
