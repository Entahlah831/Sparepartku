@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Invoice #{{ $transaction->uuid }}</h4>
            <span class="badge {{ $transaction->status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                {{ strtoupper($transaction->status) }}
            </span>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Pengiriman Ke:</h5>
                    <p>{{ Auth::user()->name }}<br>
                    {{ $transaction->address }}<br>
                    <strong>Kurir:</strong> {{ strtoupper($transaction->courier) }} ({{ $transaction->courier_service }})</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted">Tanggal: {{ $transaction->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th class="text-end">Harga</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->details as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td class="text-end">{{ number_format($detail->price) }}</td>
                        <td class="text-center">{{ $detail->qty }}</td>
                        <td class="text-end">{{ number_format($detail->price * $detail->qty) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-end">Ongkos Kirim</td>
                        <td class="text-end">{{ number_format($transaction->shipping_cost) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Grand Total</td>
                        <td class="text-end fw-bold fs-4">Rp {{ number_format($transaction->total_price) }}</td>
                    </tr>
                </tbody>
            </table>

            @if($transaction->status == 'unpaid' || $transaction->status == 'pending')
                <div class="text-end mt-4">
                    <button class="btn btn-success btn-lg" id="pay-button">Bayar Sekarang via Midtrans 💳</button>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('SB-Mid-client-RUl-DQgBxM2XaG6C') }}"></script>
    
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken dikirim dari Controller ke View ini
        snap.pay('{{ $transaction->snap_token }}', {
          onSuccess: function(result){
            /* Nanti diisi logika kalau sukses */
            window.location.reload();
          },
          onPending: function(result){
            /* Nanti diisi logika kalau pending */
            window.location.reload();
          },
          onError: function(result){
            /* Nanti diisi logika kalau gagal */
            alert("Pembayaran gagal!");
          }
        });
      };
    </script>
@endpush