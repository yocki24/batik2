<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notifAdmin();
        //ambil data pelanggan yang di join dengan table alamat, city,dan province
        $data = array(
            'pelanggan' => DB::table('users')
                ->join('alamat', 'alamat.user_id', '=', 'users.id')
                ->join('cities', 'cities.city_id', '=', 'alamat.cities_id')
                ->join('provinces', 'provinces.province_id', '=', 'cities.province_id')
                ->select('users.*', 'alamat.detail', 'cities.nama_cities as kota', 'provinces.nama_province as prov')
                ->where('users.roles', '=', 'customer')->get(),
            'notif' => $notifikasi,
            'totalPem' => $notifikasi[4]
        );
        return view('admin.pelanggan.index', $data);
    }
}
