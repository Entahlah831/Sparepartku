@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Katalog</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-5">
             <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/500' }}" class="img-fluid rounded shadow" alt="{{ $product->name }}">
        </div>
        <div class="col-md-7">
            <h1>{{ $product->name }}</h1>
            <h3 class="text-primary mt-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
            <p class="mt-3">{{ $product->description }}</p>
            
            <hr>

            <form action="{{ route('carts.store', $product->id) }}" method="POST">
                @csrf
                <div class="row align-items-center">
                    <div class="col-auto">
                        <label for="quantity" class="col-form-label">Jumlah:</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success">➕ Masukkan Keranjang</button>
                    </div>
                </div>
            </form>
            
            <div class="mt-3">
                <small class="text-muted">Stok Tersedia: {{ $product->stock }}</small>
            </div>
        </div>
    </div>
@endsection