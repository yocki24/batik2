@extends('user.app')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <strong class="text-black">All Product Batik Ciprat Langitan Simbatan</strong>
            </div>
        </div>
    </div>
    </div>

    <div class="site-section">
        <div class="container card shadow">

            <div class="row mb-4">
                <div class="col-md-9 order-2">
                    <div class="row mb-5">
                        @foreach ($produks as $produk)
                            <div class="col-sm-6 col-lg-4 mb-4 card shadow" data-aos="fade-up">
                                <div class="block-4 text-center">
                                    <a href="{{ route('user.produk.detail', ['id' => $produk->id]) }}">
                                        <img src="{{ url('storage/'.$produk->image) }}" alt="Image placeholder"
                                            class="img-fluid" width="100%" style="height:200px">
                                    </a>
                                    <div class="block-4-text p-4">
                                        <h3><a href="{{ route('user.produk.detail', ['id' => $produk->id]) }}"
                                                style="color:black">{{ $produk->name }} </a></h3>
                                        <p class="mb-0">RP {{ $produk->price }}</p>

                                        <p class="mb-0">
                                            {!! $produk->ratings_average != null
                                                ? '<span class="star">☆</span>' . number_format($produk->ratings_average, 1, ',', '.') . '/5'
                                                : 'Belum punya rating' !!}
                                        </p>
                                        <a href="{{ route('user.produk.detail', ['id' => $produk->id]) }}"
                                            class="btn btn-dark btn-block">Detail Produk</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="row" data-aos="fade-up">
                        <div class="col-md-12 text-right">
                            <div class="site-block-27">
                                {{ $produks->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 order-1 mb-5 mb-md-0">
                    <div class="border p-4 rounded mb-4 card shadow">
                        <h3 class="mb-3 h6 text-uppercase text-black d-block"><strong>Kategori</strong></h3>
                        <ul class="list-unstyled mb-0">
                            @foreach ($categories as $categori)
                                <li class="mb-1"><a href="{{ route('user.kategori', ['id' => $categori->id]) }} "
                                        class="d-flex" style="color:black"><span>{{ $categori->name }}</span> <span
                                            class="text-black ml-auto">( {{ $categori->jumlah }} )</span></a>
                                </li>
                            @endforeach
                        </ul>
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
