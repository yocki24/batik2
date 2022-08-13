@extends('user.app')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <strong class="text-black">Detail Order</strong>
                <div class="col text-right">
                <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-dark"><strong>Kembali</strong></a>
            </div>
        </div>
    </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12 text-center">
                    <h2 class="display-5">Detail Pesanan Anda</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <table>
                                        <tr>
                                            <th>No Invoice</th>
                                            <td>:</td>
                                            <td>{{ $order->invoice }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Resi</th>
                                            <td>:</td>
                                            <td>{{ $order->no_resi }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status Pesanan</th>
                                            <td>:</td>
                                            <td>{{ $order->status }}</td>
                                        </tr>
                                        <tr>
                                            <th>Metode Pembayaran</th>
                                            <td>:</td>
                                            <td>
                                                @if ($order->metode_pembayaran == 'trf')
                                                    Transfer Bank
                                                @else
                                                    COD
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total Pembayaran</th>
                                            <td>:</td>
                                            <td>Rp. {{ number_format($order->subtotal + $order->biaya_cod, 2, ',', '.') }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4 text-right">
                                    @if ($order->status_order_id == 5)
                                        <!-- <a href="{{ route('user.order.pesananditerima', ['id' => $order->id]) }}" onclik="return confirm('Yakin ingin melanjutkan ?')" class="btn btn-success">Pesanan Di Terima</a><br> -->
                                        <td class="p-2"><a
                                                href="{{ route('user.order.pesananditerima', ['id' => $order->id]) }}"
                                                onclick="return confirm('Yakin ingin mengonfirmasi pesanan ini?')"
                                                class="btn btn-warning mt-1">Pesanan Di Terima</a><br>
                                            <small>Jika pesanan belum datang harap jangan tekan tombol ini</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="product-order">order date</th>
                                                    <th class="product-thumbnail">Gambar</th>
                                                    <th class="product-name">Nama Produk</th>
                                                    <th class="product-description">Deskripsi Pesanan</th>
                                                    <th class="product-price">Jumlah</th>
                                                    <th class="product-quantity" width="20%">Total</th>
                                                    @if ($order->status_order_id == 6)
                                                        <th>
                                                            Penilaian
                                                        </th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($detail as $o)
                                                    <tr>
                                                        <td>{{ $o->created_at }}</td>
                                                        <td><img src="{{ url('storage/'. $o->image) }}" alt=""
                                                                srcset="" width="50"></td>
                                                        <td>{{ $o->nama_produk }}</td>
                                                        <td>{{ $o->pesan }}</td>
                                                        <td>{{ $o->qty }}</td>
                                                        @php
                                                            $price = (int) str_replace('.', '', $o->price);
                                                        @endphp
                                                        <td>Rp. {{ number_format($o->qty * $price, 2, ',', '.') }}</td>
                                                        @if ($order->status_order_id == 6)
                                                            @php $no_review = true; @endphp
                                                            @foreach ($penilaian_order as $rate)
                                                                @if ($rate->product_id == $o->product_id)
                                                                    @php $no_review = false; @endphp
                                                                    <td>
                                                                        <div class="rating">
                                                                            @for ($i = 5; $i > 0; $i--)
                                                                                <input type="radio" name="rating_{{ $o->product_id }}"
                                                                                    value="{{ $i }}"
                                                                                    id="{{ $o->product_id.'_'.$i }}" disabled
                                                                                    {{ $rate->star == $i ? 'checked' : '' }}><label
                                                                                    for="{{ $o->product_id.'_'.$i }}">☆</label>
                                                                            @endfor

                                                                        </div>
                                                                        <a href="{{ route('user.review.detail', ['id' => $rate->id]) }}">Lihat detail</a>
                                                                    </td>
                                                                @endif
                                                            @endforeach
                                                            @if ($no_review)
                                                                <td> <a href="{{ route('user.order.rate', ['id' => $order->id, 'prodId' => $o->product_id]) }}"
                                                                        class="mt-2 btn btn-primary">Beri Nilai</a></td>
                                                            @endif
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    @endsection
    @section('css')
        <style>
            .rating {
                display: flex;
                flex-direction: row-reverse;
                justify-content: center;
                cursor: default
            }

            .rating>input {
                display: none
            }

            .rating>label {
                position: relative;
                width: 1em;
                font-size: 30px;
                font-weight: 300;
                color: #FFD600;
            }

            .rating>label::before {
                content: "\2605";
                position: absolute;
                opacity: 0
            }

            .rating>input:checked~label:before {
                opacity: 1
            }
        </style>
    @endsection
