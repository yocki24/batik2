<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notifAdmin();
        //untuk kueri penjualan harian per pengrajin
        $queryMode = true;

        if ($request->year == null) {
            $request->year = date("Y");
        }

        //untuk kueri penjualan harian semua pengrajin jika kosong
        if ($request->pengrajin == null) {
            $queryMode = false;
        }
        $satus_order_value = DB::table('status_order')
            ->select('status_order.id', 'status_order.name')
            ->get();

        $recap = array();

        $yearlyTransaction = DB::table('order')
            ->select('order.*')
            ->where('status_order_id', 6)
            ->whereYear('created_at', '=', $request->year)
            ->get();
        $income = 0;
        foreach ($yearlyTransaction as $transaction) {
            $detail_order = DB::table('detail_order')
                ->join('products', 'products.id', '=', 'detail_order.product_id')
                ->join('order', 'order.id', '=', 'detail_order.order_id')
                ->select('products.id as product_id', 'products.name as nama_produk', 'products.image', 'detail_order.*', 'products.price', 'order.*', 'products.pengrajin_id')
                ->where('detail_order.order_id', $transaction->id)
                ->get();
            foreach ($detail_order as $product) {
                $price = (int) str_replace('.', '', $product->price);
                $subtotal = $product->qty * $price;
                $x = (object) [];
                $x->product_id = $product->product_id;
                $x->nama_produk = $product->nama_produk;
                $x->qty = $product->qty;
                $x->subtotal = $subtotal;
                $x->transaction_date = $transaction->created_at;
                $x->pengrajin_id = $product->pengrajin_id;
                $x->order_id = $transaction->id;
                $x->order_status = $satus_order_value[$transaction->status_order_id - 1]->name;
                if ($queryMode) {
                    if ($product->pengrajin_id == $request->pengrajin) {
                        array_push($recap, $x);
                        $income += $subtotal;
                    }
                } else {
                    array_push($recap, $x);
                    $income += $subtotal;
                }
            }
        }
        $pengrajinList = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('roles', 'Pengrajin')
            ->get();

        // current pengrajin
        $pengrajin = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('users.id', $request->pengrajin)
            ->first();

        $curr = date("Y");
        $years = [];
        for ($i = $curr; $i >= $curr - 10; $i--) {
            array_push($years, $i);
        }
        $data = array(
            'pengrajinList' => $pengrajinList,
            'pengrajinId' => $request->pengrajin,
            'pengrajin' => $pengrajin,
            'totalIncome' => $income,
            'transactions' => $recap,
            'year' => $request->year,
            'years' => $years,
            'notif' => $notifikasi,
            'totalPem' => $notifikasi[4]
        );
        return view('admin.reports.sales.yearly', $data);
    }
    public function monthly(Request $request)
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notifAdmin();
        //untuk kueri penjualan harian per pengrajin
        $queryMode = true;

        if ($request->year == null) {
            $request->year = date("Y");
        }
        if ($request->month == null) {
            $request->month = (int) date('m');
        }
        $request->month = (int)  $request->month;

        //untuk kueri penjualan harian semua pengrajin jika kosong
        if ($request->pengrajin == null) {
            $queryMode = false;
        }
        $satus_order_value = DB::table('status_order')
            ->select('status_order.id', 'status_order.name')
            ->get();

        $recap = array();

        $monthlyTransaction = DB::table('order')
            ->select('order.*')
            ->where('status_order_id', 6)
            ->whereYear('created_at', '=', $request->year)
            ->whereMonth('created_at', '=', $request->month)
            ->get();
        $income = 0;
        foreach ($monthlyTransaction as $transaction) {
            $detail_order = DB::table('detail_order')
                ->join('products', 'products.id', '=', 'detail_order.product_id')
                ->join('order', 'order.id', '=', 'detail_order.order_id')
                ->select('products.id as product_id', 'products.name as nama_produk', 'products.image', 'detail_order.*', 'products.price', 'order.*', 'products.pengrajin_id')
                ->where('detail_order.order_id', $transaction->id)
                ->get();
            foreach ($detail_order as $product) {
                $price = (int) str_replace('.', '', $product->price);
                $subtotal = $product->qty * $price;
                $x = (object) [];
                $x->product_id = $product->product_id;
                $x->nama_produk = $product->nama_produk;
                $x->qty = $product->qty;
                $x->subtotal = $subtotal;
                $x->transaction_date = $transaction->created_at;
                $x->pengrajin_id = $product->pengrajin_id;
                $x->order_id = $transaction->id;
                $x->order_status = $satus_order_value[$transaction->status_order_id - 1]->name;
                if ($queryMode) {
                    if ($product->pengrajin_id == $request->pengrajin) {
                        array_push($recap, $x);
                        $income += $subtotal;
                    }
                } else {
                    array_push($recap, $x);
                    $income += $subtotal;
                }
            }
        }
        $pengrajinList = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('roles', 'Pengrajin')
            ->get();

        // current pengrajin
        $pengrajin = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('users.id', $request->pengrajin)
            ->first();

        $months = get_months();

        $curr = date("Y");
        $years = [];
        for ($i = $curr; $i >= $curr - 10; $i--) {
            array_push($years, $i);
        }
        $data = array(
            'pengrajinList' => $pengrajinList,
            'pengrajinId' => $request->pengrajin,
            'pengrajin' => $pengrajin,
            'totalIncome' => $income,
            'transactions' => $recap,
            'years' => $years,
            'months' => $months,
            'month' => $request->month,
            'year' => $request->year,
            'years' => $years,
            'notif' => $notifikasi,
            'totalPem' => $notifikasi[4]
        );
        return view('admin.reports.sales.monthly', $data);
    }

    public function daily(Request $request)
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notifAdmin();
        //untuk kueri penjualan harian per pengrajin
        $queryMode = true;

        if ($request->date == null) {
            $request->date = date("d-m-Y");
        }
        $day = date("d", strtotime($request->date));
        $month = date("m", strtotime($request->date));
        $year = date("Y", strtotime($request->date));
        if ($request->month == null) {
            $request->month = (int) date('m');
        }
        //untuk kueri penjualan harian semua pengrajin jika kosong
        if ($request->pengrajin == null) {
            $queryMode = false;
        }
        $satus_order_value = DB::table('status_order')
            ->select('status_order.id', 'status_order.name')
            ->get();

        $recap = array();

        $dailyTransaction = DB::table('order')
            ->select('order.*')
            ->where('status_order_id', 6)
            ->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->whereDay('created_at', '=', $day)
            ->get();
        $income = 0;
        foreach ($dailyTransaction as $transaction) {
            $detail_order = DB::table('detail_order')
                ->join('products', 'products.id', '=', 'detail_order.product_id')
                ->join('order', 'order.id', '=', 'detail_order.order_id')
                ->select('products.id as product_id', 'products.name as nama_produk', 'products.image', 'detail_order.*', 'products.price', 'order.*', 'products.pengrajin_id')
                ->where('detail_order.order_id', $transaction->id)
                ->get();
            foreach ($detail_order as $product) {
                $price = (int) str_replace('.', '', $product->price);
                $subtotal = $product->qty * $price;
                $x = (object) [];
                $x->product_id = $product->product_id;
                $x->nama_produk = $product->nama_produk;
                $x->qty = $product->qty;
                $x->subtotal = $subtotal;
                $x->transaction_date = $transaction->created_at;
                $x->pengrajin_id = $product->pengrajin_id;
                $x->order_id = $transaction->id;
                $x->order_status = $satus_order_value[$transaction->status_order_id - 1]->name;
                if ($queryMode) {
                    if ($product->pengrajin_id == $request->pengrajin) {
                        array_push($recap, $x);
                    }
                } else {
                    array_push($recap, $x);
                }
                $income += $subtotal;
            }
        }
        $pengrajinList = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('roles', 'Pengrajin')
            ->get();

        // current pengrajin
        $pengrajin = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('users.id', $request->pengrajin)
            ->first();

        $months = get_months();
        $curr = date("Y");
        $years = [];
        for ($i = $curr; $i >= $curr - 10; $i--) {
            array_push($years, $i);
        }
        $data = array(
            'pengrajinList' => $pengrajinList,
            'pengrajinId' => $request->pengrajin,
            'pengrajin' => $pengrajin,
            'totalIncome' => $income,
            'transactions' => $recap,
            'years' => $years,
            'months' => $months,
            'month' => $month,
            'year' => $year,
            'date' => $request->date,
            'notif' => $notifikasi,
            'totalPem' => $notifikasi[4]
        );
        return view('admin.reports.sales.daily', $data);
    }
}
