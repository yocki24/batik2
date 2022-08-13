<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardpengrajinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function notif()
    {
        // untuk notifikasi pesanan baru
        $order1 = DB::table('detail_order')
            ->join('order', 'order.id', '=', 'detail_order.order_id')
            ->join('products', 'products.id', '=', 'detail_order.product_id')
            ->select(DB::raw('distinct detail_order.*', 'order.*', 'products.*'))
            ->where([['order.status_order_id', 1], ['products.pengrajin_id', auth()->user()->id]])
            ->groupBy('order.id')
            ->get();

        // untuk notifikasi perlu dicek
        $order2 = DB::table('detail_order')
            ->join('order', 'order.id', '=', 'detail_order.order_id')
            ->join('products', 'products.id', '=', 'detail_order.product_id')
            ->select(DB::raw('distinct detail_order.*', 'order.*', 'products.*'))
            ->where('products.pengrajin_id', auth()->user()->id)
            ->whereIn('order.status_order_id', [2, 3])
            ->groupBy('order.id')
            ->get();

        // untuk notifikasi perlu dikirim
        $order3 = DB::table('detail_order')
            ->join('order', 'order.id', '=', 'detail_order.order_id')
            ->join('products', 'products.id', '=', 'detail_order.product_id')
            ->select(DB::raw('distinct detail_order.*', 'order.*', 'products.*'))
            ->where([['order.status_order_id', 4], ['products.pengrajin_id', auth()->user()->id]])
            ->groupBy('order.id')
            ->get();

        // untuk notifikasi barang dikirim
        $order4 = DB::table('detail_order')
            ->join('order', 'order.id', '=', 'detail_order.order_id')
            ->join('products', 'products.id', '=', 'detail_order.product_id')
            ->select(DB::raw('distinct detail_order.*', 'order.*', 'products.*'))
            ->where([['order.status_order_id', 5], ['products.pengrajin_id', auth()->user()->id]])
            ->groupBy('order.id')
            ->get();

        $notif1 = count($order1);
        $notif2 = count($order2);
        $notif3 = count($order3);
        $notif4 = count($order4);
        return [$notif1, $notif2, $notif3, $notif4];

        $totalPem = $notif1 + $notif2 + $notif3 + $notif4;
    }

    public function index()
    {
        $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'status_order.name', 'users.name as nama_pemesan')
            ->where('order.status_order_id', 1)
            ->get();
        $notif1 = count($order);

        //ambil data data untuk ditampilkan di card pada dashboard
        $dataTransaction = DB::table('order')
            ->select('order.*')
            ->where('status_order_id', 6)
            ->orderBy('created_at', 'asc')
            ->get();
        $income = 0;
        $transaction_count = 0;
        foreach ($dataTransaction as $transaction) {
            $detail_order = DB::table('detail_order')
                ->join('products', 'products.id', '=', 'detail_order.product_id')
                ->join('order', 'order.id', '=', 'detail_order.order_id')
                ->select('products.id as product_id', 'products.name as nama_produk', 'products.image', 'detail_order.*', 'products.price', 'order.*', 'products.pengrajin_id')
                ->where('detail_order.order_id', $transaction->id)
                ->get();
            $transaction_count_flag = false;
            foreach ($detail_order as $product) {
                $price = (int) str_replace(
                    '.',
                    '',
                    $product->price
                );
                $subtotal = $product->qty * $price;
                if ($product->pengrajin_id == auth()->user()->id) {
                    $income += $subtotal;
                    $transaction_count_flag = true;
                }
            }
            if ($transaction_count_flag) {
                $transaction_count++;
            }
        }

        // menghitung jumlah pelanggan
        $pelanggan = DB::table('order')
            ->select('order.*')
            ->where('status_order_id', 6)
            ->orderBy('created_at', 'asc')
            ->get();
        $usersCount = [];
        foreach ($dataTransaction as $transaction) {
            $detail_order = DB::table('detail_order')
                ->join('products', 'products.id', '=', 'detail_order.product_id')
                ->join('order', 'order.id', '=', 'detail_order.order_id')
                ->select('products.id as product_id', 'products.name as nama_produk', 'products.image', 'detail_order.*', 'products.price', 'order.*', 'products.pengrajin_id')
                ->where('detail_order.order_id', $transaction->id)
                ->get();
            $pelanggan_count_flag = false;
            foreach ($detail_order as $product) {
                $price = (int) str_replace(
                    '.',
                    '',
                    $product->price
                );
                $subtotal = $product->qty * $price;
                if ($product->pengrajin_id == auth()->user()->id) {
                    $pelanggan_count_flag = true;
                }
            }
            if ($pelanggan_count_flag) {
                array_push($usersCount, $transaction->user_id);
            }
        }

        $jumlahUser = count(array_unique($usersCount));


        $pelanggan = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select(DB::raw('COUNT(distinct order.user_id) as total_user'))
            ->where([['order.status_order_id', '=', 6], ['users.id', '=', auth()->user()->id]])
            ->get();

        $order_terbaru = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'status_order.name', 'users.name as nama_pemesan')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        foreach ($order_terbaru as $key => $value) {
            $detail_order = DB::table('detail_order')
                ->join('products', 'products.id', '=', 'detail_order.product_id')
                ->select('products.pengrajin_id')
                ->where('detail_order.order_id', $value->id)
                ->get();
            $isTrue = false;
            foreach ($detail_order as $value) {
                if ($value->pengrajin_id == auth()->user()->id) {
                    $isTrue = true;
                }
            }
            if ($isTrue == false) {
                unset($order_terbaru[$key]);
            }
        }

        $data = array(
            'pendapatan' => $income,
            'transaksi'  => $transaction_count,
            'pelanggan'  => $jumlahUser,
            'order_baru' => $order_terbaru,
            'notif' => $this->notif(),
            'totalPem' => $this->notif()[0] + $this->notif()[1] + $this->notif()[2] + $this->notif()[3]
        );

        return view('pengrajin/dashboardpengrajin', $data);
    }
}
