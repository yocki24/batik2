<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Exports\OrderExport;
use App\Exports\OrderExportPaid;
use Illuminate\Http\Request;
use App\Order;
use App\Detailorder;
use App\Rekening;
use App\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{

    public function index()
    {
        //menampilkan semua data pesanan
        $user_id = auth()->user()->id;

        $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->select('order.*', 'status_order.name')
            ->where('order.user_id', $user_id)
            ->whereIn('order.status_order_id', [1, 2])
            ->get();


        // membuat waktu pembatalan otomatis Pemabayaran
        foreach ($order as $key => $value) {
            if ($value->status_order_id == 2 && $value->created_at < Carbon::now()->subDays(1)) {
                DB::table('order')
                    ->where('id', $value->id)
                    ->update(['status_order_id' => 7]);
            }
        }

        $dicek = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->select('order.*', 'status_order.name')
            ->where('order.status_order_id', '!=', 1)
            ->where('order.status_order_id', '!=', 2)
            ->Where('order.status_order_id', '!=', 6)
            ->Where('order.status_order_id', '!=', 7)
            ->where('order.user_id', $user_id)->get();

        $histori = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->select('order.*', 'status_order.name')
            ->where('order.status_order_id', '!=', 1)
            ->Where('order.status_order_id', '!=', 2)
            ->Where('order.status_order_id', '!=', 3)
            ->Where('order.status_order_id', '!=', 4)
            ->Where('order.status_order_id', '!=', 5)
            ->where('order.user_id', $user_id)->get();
        $data = array(
            'order' => $order,
            'dicek' => $dicek,
            'histori' => $histori
        );
        // return $order;
        return view('user.order.order', $data);
    }

    public function detail($id)
    {
        //function menampilkan detail order
        $detail_order = DB::table('detail_order')
            ->join('products', 'products.id', '=', 'detail_order.product_id')
            ->join('order', 'order.id', '=', 'detail_order.order_id')
            ->select('products.name as nama_produk', 'products.image', 'detail_order.*', 'products.price', 'order.*')
            ->where('detail_order.order_id', $id)
            ->get();
        $penilaian_order = DB::table('detail_order')
            ->join('reviews', 'reviews.product_id', '=', 'detail_order.product_id')
            ->select('reviews.*', 'detail_order.order_id')
            ->where('detail_order.order_id', $id)
            ->where('reviews.order_id', $id)
            ->get();
        $order = DB::table('order')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->select('order.*', 'users.name as nama_pelanggan', 'status_order.name as status')
            ->where('order.id', $id)
            ->first();
        $data = array(
            'detail' => $detail_order,
            'order'  => $order,
            'penilaian_order'  => $penilaian_order
        );
        // return $penilaian_order;
        return view('user.order.detail', $data);
    }

    public function sukses()
    {
        //menampilkan view terimakasih jika order berhasil dibuat
        return view('user.terimakasih');
    }

    public function kirimbukti($id, Request $request)
    {
        //mengupload bukti pembayaran
        $order = Order::findOrFail($id);
        if ($request->file('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran')->store('buktibayar', 'public');

            $order->bukti_pembayaran = $file;
            $order->status_order_id  = 3;

            $order->save();
        }
        return redirect()->route('user.order');
    }

    public function pembayaran($id)
    {
        //menampilkan view pembayaran
        $data = array(
            'rekening' => Rekening::all(),
            'order' => Order::findOrFail($id)
        );
        return view('user.order.pembayaran', $data);
    }

    public function pesananditerima($id)
    {
        //function untuk menerima pesanan
        $order = Order::findOrFail($id);
        $order->status_order_id = 6;
        $order->save();

        return redirect()->route('user.order');
    }

    public function pesanandibatalkan($id)
    {
        //function untuk membatalkan pesanan
        $order = Order::findOrFail($id);
        $order->status_order_id = 7;
        $order->save();

        return redirect()->route('user.order');
    }

    public function simpan(Request $request)
    {
        //untuk menyimpan pesanan ke table order
        $cek_invoice = DB::table('order')->where('invoice', $request->invoice)->count();
        if ($cek_invoice < 1) {
            $userid = auth()->user()->id;
            //jika pelanggan memilih metode trf maka insert data yang ini
            if ($request->metode_pembayaran == 'trf') {
                Order::create([
                    'invoice' => $request->invoice,
                    'user_id' => $userid,
                    'subtotal' => $request->subtotal,
                    'status_order_id' => 1,
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'ongkir' => $request->ongkir,
                    'no_hp' => $request->no_hp,
                    'pesan' => $request->pesan
                ]);
            }

            $order = DB::table('order')->where('invoice', $request->invoice)->first();

            $barang = DB::table('keranjang')->where('user_id', $userid)->get();
            //lalu masukan barang2 yang dibeli ke table detail order
            foreach ($barang as $brg) {
                Detailorder::create([
                    'order_id' => $order->id,
                    'product_id' => $brg->products_id,
                    'qty' => $brg->qty,
                ]);
            }
            //lalu hapus data produk pada keranjang pembeli
            DB::table('keranjang')->where('user_id', $userid)->delete();
            return redirect()->route('user.order.sukses');
        } else {
            return redirect()->route('user.keranjang');
        }
        // dd($request);

    }

    public function penilaian($id, $prodId)
    {
        $product_order = DB::table('detail_order')
            ->join('products', 'products.id', '=', 'detail_order.product_id')
            ->join('order', 'order.id', '=', 'detail_order.order_id')
            ->select('products.name', 'products.id as id', 'products.image', 'products.price', 'products.description')
            ->where('detail_order.order_id', $id)
            ->where('detail_order.product_id', $prodId)
            ->first();

        $order = DB::table('order')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->select('order.*', 'users.name as nama_pelanggan', 'status_order.name as status')
            ->where('order.id', $id)
            ->first();

        $penilaian = DB::table('reviews')
            ->select('reviews.*')
            ->where('reviews.product_id', $prodId)
            ->where('reviews.order_id', $id)
            ->first();
        // return $penilaian;
        if ($penilaian != null) {
            return redirect()->route('user.order.detail', ['id' => $id]);
        }
        if ($product_order == null) {
            return redirect()->route('user.order');
        }
        if ($order->status_order_id != 6) {
            return redirect()->route('user.order.detail', ['id' => $id]);
        }
        $data = array(
            'detail' => $product_order,
            'order'  => $order
        );
        return view('user.order.penilaian', $data);
    }
    public function postPenilaian(Request $request)
    {
        $product_order = DB::table('detail_order')
            ->join('products', 'products.id', '=', 'detail_order.product_id')
            ->join('order', 'order.id', '=', 'detail_order.order_id')
            ->select('products.name', 'products.image', 'detail_order.*', 'products.price', 'products.description', 'order.*')
            ->where('detail_order.order_id', $request->orderId)
            ->where('detail_order.product_id', $request->productId)
            ->get();

        $order = DB::table('order')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->select('order.*', 'users.name as nama_pelanggan', 'status_order.name as status')
            ->where('order.id', $request->orderId)
            ->first();
        if ($order == null) {
            return redirect()->route('user.order');
        }
        if ($order->status_order_id != 6) {
            return redirect()->route('user.order.detail', ['id' => $request->orderId]);
        }
        Review::create([
            'star' => $request->rating,
            'review' => $request->pesan,
            'product_id' => $request->productId,
            'order_id' => $request->orderId,
        ]);
        $data = array(
            'detail' => $product_order[0],
            'order'  => $order
        );
        return redirect()->route('user.order.detail', ['id' => $request->orderId])->with('status', 'Berhasil Mengubah Kategori');
    }

    public function detailReview($id)
    {
        //mengambil detail review produk
        $review = DB::table('reviews')
            ->join(
                'products',
                'products.id',
                '=',
                'reviews.product_id'
            )
            ->join('order', 'order.id', '=', 'reviews.order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('products.name as product_name', 'users.id as user_id', 'users.name as user_name', 'order.id as order_id', 'order.invoice', 'reviews.*', 'reviews.review as penilaian')
            ->where('reviews.id', $id)
            ->first();

        $responseReview = DB::table('response_review')
            ->join(
                'reviews',
                'reviews.id',
                '=',
                'response_review.review_id'
            )
            ->join('users', 'users.id', '=', 'response_review.user_id')
            ->select('response_review.*', 'users.name as user_name')
            ->where('response_review.review_id', $id)
            ->first();
        $data = array(
            'review' => $review,
            'responseReview' => $responseReview
        );
        // return $review;
        return view('user.order.detail_review', $data);
    }

    public function exportPDFAll()
    {
        $orders = Order::all();
        $pdf = PDF::loadView('order.OrderAllPdf', compact('orders'));
        return $pdf->stream('orders.pdf');
    }

    public function exportPDF()
    {
        $orders = Order::where('status', 'dibayar')->get();
        $pdf = PDF::loadView('order.OrderAllPdf', compact('orders'));
        return $pdf->stream('orders.pdf');
    }
}
