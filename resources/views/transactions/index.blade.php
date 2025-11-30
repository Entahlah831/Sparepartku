@extends('layouts.app')

@section('title', 'Riwayat Belanja')

@section('content')
<div class="container">
    <h2 class="mb-4">Riwayat Belanja Saya</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($transactions->isEmpty())
                <div class="text-center py-5">
                    <p class="text-muted">Kamu belum pernah berbelanja.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Mulai Belanja</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No. Order</th>
                                <th>Tanggal</th>
                                <th>Total Belanja</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $trx)
                            <tr>
                                <td>
                                    <small class="text-muted">#{{ substr($trx->id, 0, 8) }}...</small>
                                </td>
                                <td>{{ $trx->created_at->format('d M Y') }}</td>
                                <td>Rp {{ number_format($trx->total_price) }}</td>
                                <td>
                                    @if($trx->status == 'paid')
                                        <span class="badge bg-success">LUNAS</span>
                                    @elseif($trx->status == 'unpaid')
                                        <span class="badge bg-warning text-dark">BELUM BAYAR</span>
                                    @elseif($trx->status == 'cancelled')
                                        <span class="badge bg-danger">BATAL</span>
                                    @else
                                        <span class="badge bg-secondary">{{ strtoupper($trx->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('transactions.show', $trx->id) }}" class="btn btn-sm btn-outline-primary">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection