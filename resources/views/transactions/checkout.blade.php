@extends('layouts.app')

@section('title', 'Checkout Pesanan')

@section('content')
<div class="container">
    <h2 class="mb-4">Checkout / Pengiriman</h2>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-7">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Alamat Pengiriman</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Penerima</label>
                            <input type="text" class="form-control bg-light" value="{{ Auth::user()->name }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" rows="3" placeholder="Jalan, No Rumah, RT/RW, Kelurahan, Kecamatan..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pilih Kurir <span class="text-danger">*</span></label>
                            <select name="courier" class="form-select" required>
                                <option value="">-- Pilih Kurir --</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS Indonesia</option>
                                <option value="tiki">TIKI</option>
                            </select>
                            <small class="text-muted">Untuk saat ini ongkir dipukul rata Rp 20.000 (Dummy)</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Ringkasan Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush mb-3">
                            @php $total = 0; @endphp
                            @foreach($carts as $cart)
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0">{{ $cart->product->name }}</h6>
                                        <small class="text-muted">{{ $cart->quantity }} x Rp {{ number_format($cart->product->price) }}</small>
                                    </div>
                                    <span class="text-muted">Rp {{ number_format($cart->product->price * $cart->quantity) }}</span>
                                </li>
                                @php $total += ($cart->product->price * $cart->quantity); @endphp
                            @endforeach
                            
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div><h6 class="my-0">Ongkos Kirim</h6></div>
                                <span class="text-muted">Rp 20.000</span>
                            </li>
                            
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (IDR)</span>
                                <strong>Rp {{ number_format($total + 20000) }}</strong>
                            </li>
                        </ul>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Proses Pembayaran </button>
                        </div>
                        <div class="text-center mt-2">
                            <a href="{{ route('carts.index') }}" class="text-decoration-none">Kembali ke Keranjang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection