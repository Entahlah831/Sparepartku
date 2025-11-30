@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">Tambah Barang Baru</div>
                <div class="card-body">
                    
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Nama Produk</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Kategori</label>
                                <select name="category_id" class="form-select" required>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Harga (Rp)</label>
                                <input type="number" name="price" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Stok</label>
                                <input type="number" name="stock" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Berat (Gram)</label>
                                <input type="number" name="weight" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Foto Produk</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Simpan Produk 📦</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection