
<style>
    #order {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #order td, #order th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #order tr:nth-child(even){background-color: #f2f2f2;}

    #order tr:hover {background-color: #ddd;}

    #order th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="order" width="100%">
    <thead>
    <tr>
        <td>ID</td>
        <td>Invoice</td>
        <td>Metode Pembayaran</td>
        <td>Total</td>
        <td>Date</td>
        <td>Status</td>
        <td>Biaya COD</td>
        <td>Bukti Pembayaran</td>
    </tr>
    </thead>
    @foreach($orders as $o)
        <tbody>
        <tr>
            <td>{{ $o->id }}</td>
            <td>{{ $o->invoice }}</td>
           <td>{{ $o->metode_pembayaran }}</td>
            <td>Rp. {{ number_format($o->subtotal,0) }}</td>
            <td>{{ $o->date }}</td>
            <td>{{ ucwords($o->status) }}</td>
             <td>Rp. {{ number_format($o->biaya_cod,0) }}</td>
            <td>{{ $o->bukti_pembayaran }}</td>
        </tr>
        </tbody>
    @endforeach

</table>




