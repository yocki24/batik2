@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-dark text-white mr-2">
                    <i class="mdi mdi-home"></i>
                </span> Rekap Penjualan
            </h3>
            <nav aria-label="breadcrumb">
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['method' => 'get', 'class' => 'form-inline well well-sm']) }}
                        {{ Form::label('date', __('Rekap Penjualan pada tanggal '), ['class' => 'control-label']) }}
                        {{ Form::text('date', $date, ['required', 'class' => 'form-control', 'style' => 'width:100px']) }}
                        {{ Form::submit(__('Lihat laporan'), ['class' => 'btn btn-info btn-sm']) }}
                        {{ link_to_route('reports.sales.daily', __('Lihat laporan hari ini'), [], ['class' => 'ml-5 sm']) }}
                        {{ link_to_route(
                            'reports.sales.monthly',
                            __('Lihat laporan bulan ini'),
                            ['month' => $month, 'year' => $year],
                            ['class' => 'ml-5 sm'],
                        ) }}
                        {{ Form::close() }}
                        <hr>
                        {{ Form::open(['method' => 'get', 'class' => 'form-inline well well-sm']) }}
                        {{ Form::label('date', __('Pilih pengrajin '), ['class' => 'control-label']) }}
                        {{ Form::hidden('date', $date, ['required', 'class' => 'form-control', 'style' => 'width:100px']) }}
                        <select class="form-control ml-3 mr-3" id='year-dropdown' name="pengrajin">
                            {{--  --}}
                            <option value="">Semua pengrajin</option>
                            @foreach ($pengrajinList as $item)
                                <option value="{{ $item->id }}" {{ $pengrajinId == $item->id ? 'default selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        {{ Form::submit(__('Submit'), ['class' => 'btn btn-info btn-sm']) }}
                        {{ Form::close() }}
                        <hr>

                        <div class="panel panel-primary mt-2 mb-4">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ __('Data Rekap Penjualan Tanggal') }} {{ date('j F, Y', strtotime($date)) }}</h3>
                            </div>
                            <div class="panel-body">
                                <strong>Pengrajin : {{ $pengrajin != null ? $pengrajin->name : 'Semua' }}</strong>
                                <br>
                                <br>
                                <strong>Total transaksi : Rp.{{ number_format($totalIncome, 2, ',', '.') }}</strong>
                            </div>
                        </div>
                        <hr>
                        <div class="panel panel-success table-responsive mt-5">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ __('Detail laporan') }}</h3>

                            </div>
                            <div class="panel-body">

                                <table class="table table-bordered table-hovered" id="table">
                                    <thead>
                                        <tr>
                                        <th class="text-center">{{ __('No') }}</th>
                                        <th class="text-center">{{ __('Nama Produk') }}</th>
                                        <th class="text-center">{{ __('Tanggal transaksi') }}</th>
                                        <th class="text-center">{{ __('Status transaksi') }}</th>
                                        <th class="text-center">{{ __('Quantity') }}</th>
                                        <th class="text-center">{{ __('Total transaksi') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sum =0;
                                        @endphp
                                        @forelse($transactions as $key => $transaction)
                                            <tr>
                                                <td class="text-center">{{ 1 + $key }}</td>
                                                <td class="text-center">{{ $transaction->nama_produk }}</td>
                                                <td class="text-center">{{ date('l\, d-m-Y g:i:s A', strtotime($transaction->transaction_date)) }}</td>
                                                <td class="text-center">{{ $transaction->order_status }}</td>
                                                <td class="text-center">{{ $transaction->qty }}</td>
                                                <td class="text-right">{{ format_rp($transaction->subtotal) }}</td>
                                            </tr>
                                            @php
                                                $sum += $transaction->subtotal;
                                            @endphp
                                        @empty
                                            <tr>
                                                <td colspan="6">{{ __('transaction.not_found') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">{{ __('Total') }}</th>
                                            <th colspan="4">&nbsp;</th>
                                            <th class="text-right">{{ format_rp($sum) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('ext_css')
    {{ Html::style(url('css/plugins/jquery.datetimepicker.css')) }}
@endsection

@section('script')
    {{ Html::script(url('js/plugins/jquery.datetimepicker.js')) }}
    <script>
        (function() {
            $('#date').datetimepicker({
                timepicker: false,
                format: 'Y-m-d',
                closeOnDateSelect: true,
                scrollInput: false
            });
        })();
    </script>
@endsection
