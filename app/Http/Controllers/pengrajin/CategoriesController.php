<?php

namespace App\Http\Controllers\pengrajin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Categories;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notif();
        //Ambil data kategori dari database
        $data = array(
            'categories' => Categories::all(),
            'notif' => $notifikasi,
            'totalPem' => $notifikasi[4]
        );
        //menampilkan view
        return view('pengrajin.categories.index', $data);
    }

    //function menampilkan view tambah data
    public function tambah()
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notif();

        $data['notif'] = $notifikasi;
        $data['totalPem'] = $notifikasi[4];

        return view('pengrajin.categories.tambah', $data);
    }

    public function store(Request $request)
    {
        //Simpan datab ke database    
        Categories::create([
            'name' => $request->name
        ]);

        //lalu reireact ke route admin.categories dengan mengirim flashdata(session) berhasil tambah data untuk manampilkan alert succes tambah data
        return redirect()->route('pengrajin.categories')->with('status', 'Berhasil Menambah Kategori');
    }

    public function update($id, Request $request)
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notif();

        $data['notif'] = $notifikasi;
        $data['totalPem'] = $notifikasi[4];

        //ambil data sesuai id dari parameter
        $categorie = Categories::FindOrFail($id);
        //lalu ambil apa aja yang mau diupdate
        $categorie->name = $request->name;

        //lalu simpan perubahan
        $categorie->save();
        return redirect()->route('pengrajin.categories', $data)->with('status', 'Berhasil Mengubah Kategori');
    }

    //function menampilkan form edit
    public function edit($id)
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notif();

        $data = array(
            'categorie' => $categorie = Categories::FindOrFail($id),
            'notif' => $notifikasi,
            'totalPem' => $notifikasi[4]
        );
        return view('pengrajin.categories.edit', $data);
    }

    public function delete($id)
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notif();

        $data['notif'] = $notifikasi;
        $data['totalPem'] = $notifikasi[4];

        //hapus data sesuai id dari parameter
        Categories::destroy($id);

        return redirect()->route('pengrajin.categories')->with('status', 'Berhasil Mengahapus Kategori');
    }
}
