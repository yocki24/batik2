@extends('user.app')
@section('content')
<!-- <div class="site-blocks-cover" style="background-image: url({{ asset('shopper') }}/images/batek.jpg);" data-aos="fade">
</div>
<div class="container">
    <div class="row align-items-start align-items-md-center justify-content-end">
        <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
        <h1 class="mb-2"><strong>Cari Kebutuhan Batik Kamu hanya di Batik Ciprat Langitan </strong></h1>
        <h5 class="mb-2"><strong>Selamat Berbelanja, Di Batik Ciprat Langitan Simbatan.....</strong></h5>
        <div class="intro-text text-center text-md-left">
            <p class="mb-4">Batik Ciprat Langitan Simbatan yang terjamin kualitasnya dan tentunya barangnya juga original. </p>
            <p>
            <a href="{{ route('user.produk') }}" class="btn btn-sm btn-primary">Belanja Sekarang</a>
            </p>
        </div>
        </div>
    </div>
    </div>
<!-- Blog Post -->
<!-- <div class="card mb-4" style="background-color:white; width: 100%;"> -->
<div>
<section class="site hero" style="background-image: url(images/bg4.jpg); width: 100%; background-size: cover; background-repeat: no-repeat;
            background-position: center; background-attachment: fixed;
            height: 100%;" id="section-home" data-stellar-background-ratio="0.5">
<div class="container">
    <div class="row intro-text align-items-center justify-content-center">
        <div class="col-md-10 animated tada">
            <br><br><br><br><br><br><br>
            <h1 class="site-heading site-animate"><font color="lavender"><h1>Hello, Dear!!<strong class="d-block">Welcome to Batik Ciprat Langitan Simbatan Store</strong</h1>
            <strong class="d-block text-white text-uppercase letter-spacing"><font color="lavender">Happy Shopping</strong>
<br><br><br>
            <div class="container">
    <div class="row align-items-start align-items-md-center justify-content-end">
        <div class="col-md-8 text-center text-md-left pt-5 pt-md-0">
        <h3 class="mb-2"><strong> <font color="lavender">Cari Kebutuhan Batik Kamu hanya di Batik Ciprat Langitan</strong> </h3><br>
        <h6 class="mb-2"><font color="white"><h5>Selamat Berbelanja, Di Batik Ciprat Langitan Simbatan.....</h6>
        <div class="intro-text text-center text-md-left">
            <h4 class="mb-3"><font color="lavender">Batik Ciprat Langitan Simbatan yang terjamin kualitasnya dan tentunya barangnya juga original. </h4>
            <p>
            <a href="{{ route('user.produk') }}" class="btn btn-sm btn-dark">Belanja Sekarang</a>
            </p>
        </div>
        </div>
    </div>
    </div>
            <br><br><br><br><br>
</div>
</div>
</div>
</section>
<div class="site-section block-3 site-blocks-2 bg-secondary"  data-aos="fade-up">
<div class="site-section-sm">
    <div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
        <div class="icon mr-4 align-self-start">
            <span class="icon-truck"></span>
        </div>
        <div class="text">
            <h5><strong>Pengiriman</strong></h5>
            <p>Pengiriman bisa ke seluruh wilayah Indonesia dengan JNE, TIKI, POS</p>
        </div>
        </div>
        <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
        <div class="icon mr-4 align-self-start">
            <span class="icon-star"></span>
        </div>
        <div class="text">
            <h5><strong>Kualitas Barang Oke</strong></h5>
            <p>Kualitas barang dari store kami terjamin karena semua di sini original dan berkualitas.</p>
        </div>
        </div>
        <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
        <div class="icon mr-4 align-self-start">
            <span class="icon-security"></span>
        </div>
        <div class="text">
            <h5><strong>Keamanan</strong></h5>
            <p>Kami menjamin keamanan dalam pengiriman barang sampai diterima oleh anda.</p>
        </div>
        </div>
    </div>
    </div>
</div>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 site-section-heading text-center pt-4">
        <h3><strong>Best Seller<strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="nonloop-block-3 owl-carousel" >
            @foreach($produks as $produk)
            <div class="item">
            <div class="block-4 text-center">
                <a href="{{ route('user.produk.detail',['id' =>  $produk->id]) }}">
                <figure class="block-4-image">
                <img src="{{ url('storage/'.$produk->image) }}" width="100%" style="height:300px"> 
                </a>
                <div class="block-4-text p-4">
                <h3><a href="{{ route('user.produk.detail',['id' =>  $produk->id]) }}" style= "color:black">{{ $produk->name }}</a></h3>
                <p class="mb-0" style="color:black">{{ $produk->price }}</p>
                <a href="{{ route('user.produk.detail',['id' =>  $produk->id]) }}" class="btn btn-dark btn-block">Detail</a>
                </div>
            </div>
            </div>
            @endforeach
        </div>
        </div>
    </div>
    </div>
</div>
    @endsection