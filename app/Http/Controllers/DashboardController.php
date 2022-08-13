<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use App\Rekening;
use App\Order;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notifAdmin();
        //ambil data data untuk ditampilkan di card pada dashboard
        $pendapatan = DB::table('order')
            ->select(DB::raw('SUM(subtotal) as penghasilan'))
            ->where('status_order_id', 6)
            ->first();
        $transaksi = DB::table('order')
            ->select(DB::raw('COUNT(id) as total_order'))
            ->first();
        $pelanggan = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select(DB::raw('COUNT(distinct order.user_id) as total_user'))
            ->where('order.status_order_id', '=', 6)
            ->first();

        $order_terbaru = $order = DB::table('order')
            ->join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'status_order.name', 'users.name as nama_pemesan')
            ->limit(10)
            ->get();
        $data = array(
            'pendapatan' => $pendapatan,
            'transaksi'  => $transaksi,
            'pelanggan'  => $pelanggan,
            'order_baru' => $order_terbaru,
            'notif' => $notifikasi,
            'totalPem' => $notifikasi[4]
        );

        return view('admin/dashboard', $data);
    }
}
