@extends('user.app')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <strong class="text-black">Detail Review</strong>
            </div>
        </div>
    </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12 text-center">
                    <h2 class="display-5">Detail Review Anda</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <table>
                                        <div class="col text-right">
                <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-dark"><strong>Kembali</strong></a>
                                        <tr>
                                            <td>Date</td>
                                            <td>:</td>
                                            <td class="p-2">{{ $review->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Product</td>
                                            <td>:</td>
                                            <td class="p-2">{{ $review->product_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>No Invoice</td>
                                            <td>:</td>
                                            <td class="p-2">
                                                <a
                                                    href="{{ route('pengrajin.transaksi.detail', ['id' => $review->order_id]) }}">{{ $review->invoice }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama User</td>
                                            <td>:</td>
                                            <td class="p-2">
                                                {{ $review->user_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rating Penilaian</td>
                                            <td>:</td>
                                            <td class="p-2">
                                                <div class="rating">
                                                    @for ($i = 5; $i > 0; $i--)
                                                        <input type="radio" name="rating_{{ $review->product_id }}"
                                                            value="{{ $i }}"
                                                            id="{{ $review->product_id . '_' . $i }}" disabled
                                                            {{ $review->star == $i ? 'checked' : '' }}><label
                                                            for="{{ $review->product_id . '_' . $i }}">☆</label>
                                                    @endfor
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Catatan Penilaian</td>
                                            <td>:</td>
                                            <td class="p-2">{{ $review->penilaian }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <h4 class="card-title">
                                                Tanggapan
                                            </h4>
                                        </div>
                                    </div>
                                    @if ($responseReview == null)
                                        Tidak ada tanggapan
                                    @else
                                        <div class="comment mt-4 text-justify float-left ">
                                            <img src="{{ asset('images') }}/user.jpg" alt=""
                                                class="rounded-circle" width="40" height="40">
                                            <h6>{{ $responseReview->user_name }}</h6>
                                            <p class="date-post ml-3">{{ date('l\, d-m-Y g:i:s A', strtotime($responseReview->created_at)) }}</p>
                                            <br>
                                            <p class="mt-3"> {{ $responseReview->tanggapan }}</p>
                                        </div>
                                        <div>
                                            <br>
                                        </div>
                                    @endif

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

        .comment {
            border: 1px solid rgba(16, 46, 46, 1);
            background-color: rgba(255, 255, 255, 0.973);
            float: left;
            border-radius: 5px;
            padding-left: 40px;
            padding-right: 30px;
            padding-top: 10px;
            width: 100%;

        }

        .comment h6,
        .comment p.date-post,
        .darker h6,
        .darker p.date-post {
            display: inline;
        }

        .comment p,
        .comment p.date-post,
        .darker p,
        .darker p.date-post {
            color: rgb(112, 112, 112);
        }
    </style>
@endsection
