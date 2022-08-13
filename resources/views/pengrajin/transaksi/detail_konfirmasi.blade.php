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
                      <h4 class="card-title">Detail Pesanan {{ $order->nama_pelanggan }}</h4>
                      </div>
                      <div class="col text-right">
                      <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-dark"><strong>Kembali</strong></a>
                      </div>
                    </div>
                    <hr>
                   <div class="row">
                   <div class="col-md-7">
                    <table>
                         <tr>
                            <td>Date</td>
                            <td>:</td>
                            <td  class="p-2">{{ $order->created_at }}</td>
                        </tr>
                        <tr>
                            <td>No Invoice</td>
                            <td>:</td>
                            <td  class="p-2">{{ $order->invoice }}</td>
                        </tr>
                        <tr>
                            <td>Metode Pembayaran</td>
                            <td>:</td>
                            <td  class="p-2">{{ $order->metode_pembayaran }}</td>
                        </tr>
                        <tr>
                            <td>Status Pesanan</td>
                            <td>:</td>
                            <td  class="p-2">{{ $order->status }}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>:</td>
                            <td  class="p-2">Rp. {{ number_format($order->subtotal,2,',','.') }} ( Sudah Termasuk Ongkir )</td>
                        </tr>
                        <tr>
                            <td>Biaya Ongkir</td>
                            <td>:</td>
                            <td  class="p-2">Rp. {{ number_format($order->ongkir,2,',','.') }}</td>
                        </tr>
                        <tr>
                            <td>Kurir</td>
                            <td>:</td>
                            <td  class="p-2">JNE</td>
                        </tr>
                        @endif
                        <tr>
                            <td>No Hp</td>
                            <td>:</td>
                            <td  class="p-2">{{ $order->no_hp }}</td>
                        </tr>
                        <tr>
                            <td>Catatan Pelanggan</td>
                            <td>:</td>
                            <td  class="p-2">{{ $order->pesan }}</td>
                        </tr>
                        
                        @if($order->status_order_id == 2)
                        <tr>
                            <td></td>
                            <td></td>
                            <td  class="p-2"><a href="{{ route('pengrajin.transaksi.konfirmasi',['id' => $order->id]) }}" onclick="return confirm('Yakin ingin mengonfirmasi pesanan ini?')" class="btn btn-warning mt-1">Konfirmasi Pesanan</a><br>
                            </td>
                        </tr>
                        @endif
                            </div>
                            </div>
                            </form>
                            </td>
                        </tr>
                        @endif
                    </table>
                    </div>
                    <div class="col-md-5">
                    <div class="table-responsive">
                      <table class="table table-bordered table-hovered" >
                        <thead class="bg-secondary text-white">
                          <tr>
                            <th width="5%">No</th>
                            <th>Nama Produk</th>
                            <th>QTY</th>
                            <th>Total Harga</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;?>
                            @foreach($detail as $dt)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $dt->nama_produk }}</td>
                                <td>{{ $dt->qty }}</td>
                                <td>{{ $dt->qty * $dt->price }}</td>
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
