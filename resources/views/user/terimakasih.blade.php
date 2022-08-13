@extends('user.app')
@section('content')

<div class="bg-light py-3">
    <div class="container">
    <div class="row">
        <strong class="text-black">Order</strong></div>
    </div>
    </div>
</div>  

<div class="site-section">
    <div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
        <span class="icon-check_circle display-3 text-success"></span>
        <h2 class="display-3 text-black">Terimakasih Telah Berbelanja di SWP Shopping!</h2>
        <p class="lead mb-5">Kamu berhasil memesan. <br>
        Silahkan konfirmasi pembayaran melalui Menu Pembayaran</p>
        <p><a href="{{ route('user.order') }}" class="btn btn-sm btn-block btn-success">Menu Pembayaran</a></p>
        </div>
    </div>
    </div>
</div>
@endsection