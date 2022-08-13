@extends('user.app')
@section('content')
<div class="bg-light py-3">
    <div class="container">
    <div class="row">
        <strong class="text-black">Detail Produk</strong></div>
    </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
    <div class="row">
        <div class="col-md-6 card shadow card body">
        <img src="{{ url('storage/'.$produk->image) }}" width="100%" style="height:100%">
        </div>
        <div class="col-md-4">
        <h2 class="text-black">{{ $produk->name }}</h2>
        <p>
            {!! $produk->ratings_average != null
                                                ? '<span class="star">☆</span>' . number_format($produk->ratings_average, 1, ',', '.') . '/5'
                                                : 'Belum punya rating' !!}
        </p>
        <p><strong class="text-dark h4">Rp {{ $produk->price }} </strong>
        @csrf
        @if($produk->stok != null)
        <span class="badge badge-success"> <i class="fas fa-check"></i> Ready Stock </span>
        @else
        <span class="badge badge-danger"> <i class="fas fa-check"></i> Pre Order </span>
        @endif
        </p>
        <h6>Deskripsi Produk: {{ $produk->description }}</h6>
        <h6> Berat : {{ $produk->weigth }}gr</h6>
        <div class="mb-5">
            <form action="{{ route('user.keranjang.simpan') }}" method="post">
                @csrf
                @if(Route::has('login'))
                    @auth
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    @endauth
                @endif
            <input type="hidden" name="products_id" value="{{ $produk->id }}">
             <h6>Stok : {{ $produk->stok }}</h6>
            <input type="hidden" value="{{ $produk->stok }}" id="sisastok">
            <div class="input-group mb-3" style="max-width: 120px;">
            <div class="input-group-prepend">
            <button class="btn btn-outline-dark js-btn-minus" type="button">&minus;</button>
            </div>
            <input type="text" name="qty" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
            <div class="input-group-append">
            <button class="btn btn-outline-dark js-btn-plus" type="button">&plus;</button>
            </div>
</div>
        </div>
        <p><button type="submit" class="buy-now btn btn-sm btn-dark btn-block">Tambahkan ke Keranjang</button></p>
        </form>
        </div>
    </div>
    </div>
</div>
  </div>
@endsection
@section('css')
    <style>
        span.star {
            position: relative;
            width: 1em;
            font-size: 30px;
            font-weight: 300;
            color: #FFD600;
        }

        span.star::before {
            content: "\2605";
            position: absolute;
            opacity: 1
        }
    </style>
@endsection
