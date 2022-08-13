@extends('admin.layout.app')

@section('title', __('report.monthly', ['year_month' => $months[$month] . ' ' . $year]))

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
                        {{ Form::label('month', __('Rekap Penjualan pada'), ['class' => 'control-label']) }}
                        <select class="form-control" id='year-dropdown' name="month">
                            @foreach ($months as $key => $item)
                                <option value="{{ $key + 1 }}" {{ $key + 1 == $month ? 'default selected' : '' }}>
                                    {{ $item }}</option>
                            @endforeach
                        </select>
                        <select class="form-control" id='year-dropdown' name="year">
                            @foreach ($years as $item)
                                <option value="{{ $item }}" {{ $item == $year ? 'default selected' : '' }}>
                                    {{ $item }}</option>
                            @endforeach
                        </select>
                        {{ Form::submit(__('Lihat laporan'), ['class' => 'btn btn-info btn-sm']) }}
                        {{ link_to_route('reports.sales.monthly', __('Lihat laporan bulan ini'), [], ['class' => 'ml-5 sm']) }}
                        {{ link_to_route('reports.sales.yearly', __('Lihat laporan tahun ini'), ['year' => $year], ['class' => 'ml-5 sm']) }}
                        {{ Form::close() }}
                        <hr>
                        {{ Form::open(['method' => 'get', 'class' => 'form-inline well well-sm']) }}
                        {{ Form::label('pengrajin', __('Pilih pengrajin '), ['class' => 'control-label']) }}
                        {{ Form::hidden('month', $month, ['required', 'class' => 'form-control', 'style' => 'width:100px']) }}
                        <select class="form-control ml-3 mr-3" id='year-dropdown' name="pengrajin">
                            {{--  --}}
                            <option value="">Semua pengrajin</option>
                            @foreach ($pengrajinList as $item)
                                <option value="{{ $item->id }}"
                                    {{ $pengrajinId == $item->id ? 'default selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        {{ Form::submit(__('Submit'), ['class' => 'btn btn-info btn-sm']) }}
                        {{ Form::close() }}
                        <hr>
                        <div class="panel panel-primary mt-2 mb-4">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ __('Data Rekap Penjualan Bulan') }} {{ $months[$month - 1] }}
                                    {{ $year }}</h3>
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
                                            $sum = 0;
                                            $chartData = [];
                                        @endphp
                                        @forelse($transactions as $key => $transaction)
                                            <tr>
                                                <td class="text-center">{{ 1 + $key }}</td>
                                                <td class="text-center">{{ $transaction->nama_produk }}</td>
                                                <td class="text-center">
                                                    {{ date('l\, d-m-Y g:i:s A', strtotime($transaction->transaction_date)) }}
                                                </td>
                                                <td class="text-center">{{ $transaction->order_status }}</td>
                                                <td class="text-center">{{ $transaction->qty }}</td>
                                                <td class="text-right">{{ format_rp($transaction->subtotal) }}</td>
                                            </tr>
                                            @php
                                                $sum += $transaction->subtotal;
                                            @endphp
                                        @empty
                                            <tr>
                                                <td colspan="6">{{ __('Tidak ada transaksi') }}</td>
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
    {{ Html::style(url('css/plugins/morris.css')) }}
@endsection

@push('ext_js')
    {{ Html::script(url('js/plugins/raphael.min.js')) }}
    {{ Html::script(url('js/plugins/morris.min.js')) }}
@endpush

@section('script')
    <script>
        (function() {
            new Morris.Line({
                element: 'monthly-chart',
                data: {!! collect($chartData)->toJson() !!},
                xkey: 'date',
                ykeys: ['value'],
                labels: ["{{ __('report.omzet') }} Rp"],
                parseTime: false,
                xLabelAngle: 30,
                goals: [0],
                goalLineColors: ['red'],
                lineWidth: 2,
            });
        })();
    </script>
@endsection
