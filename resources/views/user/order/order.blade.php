@extends('user.app')
@section('content')
<div class="bg-light py-3">
    <div class="container">
    <div class="row">
        <strong class="text-black">Riwayat Pesanan</strong></div>
    </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <h2 class="btn btn-dark btn-block text-white">Belum Dibayar</h2>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
           <div class="table-responsive">
           <div class="table-responsive">
           <table class="table table-bordered">
            <thead>
                <tr>
                <th class="product-name">Date</th>
                <th class="product-thumbnail">Invoice</th>
                <th class="product-name">Total</th>
                <th class="product-price">Status</th>
                <th class="product-price" width="20%">Bayar Sebelum</th>
                <th class="product-quantity" width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order as $o)
                <tr>
                    <td>{{ $o->created_at }}</td>
                    <td>{{ $o->invoice }}</td>
                    <td>{{ $o->subtotal + $o->biaya_cod }}</td>
                    <td>{{ $o->status_order_id == 1 ? 'Tunggu konfirmasi pengrajin' :  $o->name}}</td>
                    <td>
                        @if($o->status_order_id == 2) {{ Carbon\Carbon::parse ($o->created_at) -> addDays(1)}}
                        @else
                            Belum Dikonfirmasi
                        @endif
                    </td>
                    <td>
                        @if ($o->status_order_id != 1)
                            <a href="{{ route('user.order.pembayaran',['id' => $o->id]) }}" class="btn btn-success">Bayar</a>      
                        @endif
                    <a href="{{ route('user.order.pesanandibatalkan',['id' => $o->id]) }}" onclick="return confirm('Yakin ingin membatalkan pesanan')" class="btn btn-danger">Batalkan</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
            </div>
           </div>
        
    </div>

    </div>

    <div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <h2 class="btn btn-dark btn-block text-white">Sedang Dalam Proses</h2>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <table class="table table-bordered">
            <thead>
                <tr>
                <th class="product-date">Date</th>
                <th class="product-thumbnail">Invoice</th>
                <th class="product-name">Total</th>
                <th class="product-price">Status</th>
                <th class="product-quantity" width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dicek as $o)
                <tr>
                    <td>{{ $o->created_at }}</td>
                    <td>{{ $o->invoice }}</td>
                    <td>{{ $o->subtotal + $o->biaya_cod }}</td>
                    <td>
                        @if($o->name == 'Perlu Di Cek')
                        Sedang Di Cek
                        @else
                        {{ $o->name }}
                        @endif
                    </td>
                    <td>
                    <a href="{{ route('user.order.detail',['id' => $o->id]) }}" class="btn btn-success">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        
    </div>

    <div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <h2 class="btn btn-dark btn-block text-white">Riwayat Pesanan Anda</h2>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="table-responsive">
            <table class="table table-bordered">
            <thead>
                <tr>
                <th class="product-date">Date</th>
                <th class="product-thumbnail">Invoice</th>
                <th class="product-name">Total</th>
                <th class="product-price">Status</th>
                <th class="product-quantity" width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histori as $o)
                <tr>
                    <td>{{ $o->created_at }}</td>
                    <td>{{ $o->invoice }}</td>
                    <td>{{ $o->subtotal + $o->biaya_cod }}</td>
                    <td>{{ $o->name }}</td>
                    <td>
                    <a href="{{ route('user.order.detail',['id' => $o->id]) }}" class="btn btn-success">Detail</a>
                    @if ($o->status_order_id == 5)
                        {{-- <a href="{{ route('user.order.rate',['id' => $o->id]) }}" class="mt-2 btn btn-primary">Beri Penilaian</a> --}}
                    @endif 
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
            </div>
        
    </div>

    </div>
</div>
@endsection