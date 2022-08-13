<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE = edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <title> Rekap Penjualan PDF </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            border-color: #a5a5a5;

        }

        .col1 {
            width: 100px;
        }

        .col2 {
            width: 500px;
            ;
        }
    </style>
</head>

<body>
    <div class="panel panel-primary mt-2 mb-4">
        <div class="panel-heading">
            <h3 class="panel-title">{{ __('Data Rekap Penjualan Tanggal') }} {{ date('j F, Y', strtotime($date)) }}</h3>
        </div>
        <div class="panel-body">
            <strong>Pengrajin : {{ $pengrajin != null ? $pengrajin->name : 'Semua' }}</strong>
            <br>
            <br>
            <strong>Rp.{{ number_format($totalIncome, 2, ',', '.') }}</strong>
        </div>
    </div>
    <hr>
    <div class="panel panel-success table-responsive mt-5">
        <div class="panel-heading">
            <h3 class="panel-title">{{ __('Detail laporan') }}</h3>

        </div>
        <div class="panel-body">

            <table class="table table-condensed table-hover">
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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KinkN" crossorigin="anonymous">
</script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

