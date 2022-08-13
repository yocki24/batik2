@extends('admin.layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-home"></i>
                </span> Penilaian
            </h3>
            <nav aria-label="breadcrumb">
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <h4 class="card-title">Penilaian Produk</h4>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hovered" id="table">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th title="Field #1">Tanggal Penilaian</th>
                                        <th title="Field #2">Nama Produk</th>
                                        <th title="Field #3">Rating</th>
                                        <th title="Field #5">Nama User</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $rev)
                                        <tr>
                                            <td align="center"></td>
                                            <td>{{ $rev->created_at }}</td>
                                            <td>{{ $rev->product_name }}</td>
                                            <td>
                                                <div class="rating">
                                                    @for ($i = 5; $i > 0; $i--)
                                                        <input type="radio"
                                                            name="rating_{{ $rev->product_id . '_' . $rev->order_id }}"
                                                            value="{{ $i }}"
                                                            id="{{ $rev->product_id . '_' . $rev->order_id . '_' . $i }}"
                                                            disabled {{ $rev->star == $i ? 'checked' : '' }}><label
                                                            for="{{ $rev->product_id . '_' . $rev->order_id . '_' . $i }}">☆</label>
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>{{ $rev->user_name }}</td>
                                            <td align="center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('admin.review.detail', ['id' => $rev->id]) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="mdi mdi-tooltip-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--begin: Datatable-->

        <!--end: Datatable-->
    </div>
@endsection
@section('js')
    <script>
        t.destroy();

        t = $('#table').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [
                [1,  'desc']
            ],
            "language": {
                "sProcessing": "Sedang memproses ...",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecord": "Maaf data tidak tersedia",
                "info": "Menampilkan _PAGE_ halaman dari _PAGES_ halaman",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "sSearch": "Cari",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                }
            }   
        });
    </script>
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
