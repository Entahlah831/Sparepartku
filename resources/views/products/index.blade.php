@extends('layouts.app')

@section('title', 'Katalog Sparepart')

@section('content')
    <h2 class="mb-4">Katalog Sparepart Terlengkap</h2>

    <div class="row">
        @forelse($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/300' }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-primary fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>Belum ada produk yang tersedia.</p>
            </div>
        @endforelse
    </div>
@endsection