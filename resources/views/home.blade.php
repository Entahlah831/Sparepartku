@extends('layouts.app')

@section('title', 'Halaman Utama')

@section('content')

<style>
    .hero-section {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url("{{ asset('images/bengkel-bg.jpg') }}");
        background-size: cover;
        background-position: center;
        height: 500px; 
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }
</style>

<div class="hero-section mb-5">
    <div class="text-center">
        <h1 class="display-4 fw-bold">Selamat Datang diSparepartku.com</h1>
        <p class="lead mb-4">Solusi Sparepart Terlengkap dan Terpercaya untuk Kendaraan Anda</p>
        
        <a href="{{ route('products.index') }}" class="btn btn-warning btn-lg fw-bold px-5">
            Belanja Sekarang ➡️
        </a>
    </div>
</div>

<div class="row text-center">
    <div class="col-md-4">
        <h3>🚀 Pengiriman Cepat</h3>
        <p>Bekerjasama dengan JNE & kurir terpercaya.</p>
    </div>
    <div class="col-md-4">
        <h3>💎 Barang Original</h3>
        <p>Garansi uang kembali jika barang palsu.</p>
    </div>
    <div class="col-md-4">
        <h3>💳 Pembayaran Mudah</h3>
        <p>Support QRIS, Virtual Account via Midtrans.</p>
    </div>
</div>

@endsection