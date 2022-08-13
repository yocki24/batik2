@extends('pengrajin.layout2.footer')
@section('content')
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-dark text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Pesanan </h3>
              <nav aria-label="breadcrumb">
              </nav>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row mb-3">
                      <div class="col">
                      <h4 class="card-title">Data Pesanan Baru</h4>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-bordered table-hovered" id="table">
                        <thead>
                          <tr>
                            <th width="5%">No</th>
                            <th>Date</th>
                            <th>No Invoice</th>
                            <th>Pemesan</th>
                            <th>Subtotal</th>
                            <th>Metode Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th width="15%">Aksi</th>

                          </tr>
                        </thead>
                        <tbody>
                          @foreach($orderbaru as $order)
                            <tr>
                                <td align="center"></td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->invoice }}</td>
                                <td>{{ $order->nama_pemesan }}</td>
                                <td>{{ $order->subtotal + $order->biaya_cod }}</td>
                                <td>{{ $order->metode_pembayaran }}</td>
                                <td>@if($order->name == 'Tunggu Konfirmasi') Konfirmasi Sebelum <br> {{ Carbon\Carbon::parse ($order->created_at) -> addDays(1)}}
                                    @else
                                        {{ $order->name}}
                                    @endif
                                </td>
                                <td align="center">
                            <div>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                  <a href="{{ route('pengrajin.transaksi.detail_konfirmasi',['id'=>$order->id]) }}" class="btn btn-warning btn-sm">
                                    <strong>Lihat Detail</strong>
                                  
                                    
                                      <a href="{{ route('pengrajin.transaksi.konfirmasi_pesanan',['id' => $order->id]) }}" onclick="return confirm('Yakin ingin mengonfirmasi pesanan ini?')" class="btn btn-success mr-1">Konfirmasi Pesanan</a><br>
                                      <a href="{{ route('pengrajin.transaksi.batalkan_pesanan',['id' => $order->id]) }}" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')" class="btn btn-danger mr-1">Batalkan Pesanan</a><br>
                            {{-- <small>Klik tombol ini jika pembeli sudah terbukti melakukan konfirmasi pesanan</small> --}}
                            </td>

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
          </div>
          
@endsection
