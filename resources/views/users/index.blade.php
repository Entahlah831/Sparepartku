@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm text-center py-4">
            <div class="mx-auto bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px; font-size: 40px; font-weight: bold;">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            
            <h4>{{ Auth::user()->name }}</h4>
            <p class="text-muted">{{ Auth::user()->email }}</p>
            <p class="small text-muted">Bergabung sejak: {{ Auth::user()->created_at->format('d M Y') }}</p>

            <div class="card-body">
                <a href="{{ route('users.edit') }}" class="btn btn-outline-primary w-100 mb-2">⚙️ Edit Profil & Password</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Keluar / Logout</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Aktivitas Saya</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="p-3 border rounded bg-light">
                            <h3 class="fw-bold text-primary">{{ $total_transaksi ?? 0 }}</h3>
                            <p class="mb-0 text-muted">Total Transaksi</p>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="p-3 border rounded bg-light">
                            <h3 class="fw-bold text-warning">{{ $pending_transaksi ?? 0 }}</h3>
                            <p class="mb-0 text-muted">Menunggu Pembayaran</p>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <h6 class="mb-3">Menu Cepat:</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('carts.index') }}" class="btn btn-light text-start border">🛒 Cek Keranjang Belanja</a>
                    <a href="{{ route('transactions.index') }}" class="btn btn-light text-start border">📜 Lihat Riwayat Pesanan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection