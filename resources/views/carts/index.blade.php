@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <h2 class="mb-4">Keranjang Belanja</h2>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($carts as $cart)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                             <img src="{{ $cart->product->image ? asset('storage/'.$cart->product->image) : 'https://via.placeholder.com/50' }}" width="50" class="me-3">
                            <span>{{ $cart->product->name }}</span>
                        </div>
                    </td>
                    <td>Rp {{ number_format($cart->product->price) }}</td>
                    <td width="15%">
                        <input type="number" class="form-control" value="{{ $cart->quantity }}" min="1">
                    </td>
                    <td>Rp {{ number_format($cart->product->price * $cart->quantity) }}</td>
                    <td>
                        <form action="#" method="POST"> @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @php $total += ($cart->product->price * $cart->quantity); @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total Belanja:</td>
                    <td colspan="2" class="fw-bold fs-5">Rp {{ number_format($total) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali Belanja</a>
        <a href="{{ route('transactions.checkout') }}" class="btn btn-primary btn-lg">Lanjut ke Pembayaran ➡️</a>
    </div>
@endsection