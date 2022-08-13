<?php

namespace App\Http\Controllers\pengrajin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notif();

        //membawa data produk yang di join dengan table kategori
        $idUser = auth()->user()->id;
        $products = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.categories_id')
            ->select('products.*', 'categories.name as nama_kategori')
            ->where('products.pengrajin_id', $idUser)
            ->get();
        $data = array(
            'products' => $products,
            'notif' => $notifikasi,
            'totalPem' => $notifikasi[4]
        );
        return view('pengrajin.product.index', $data);
    }

    public function tambah()
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notif();

        //menampilkan form tambah kategori
        $data = array(
            'categories' => Categories::all(),
            'notif' => $notifikasi,
            'totalPem' => $notifikasi[4]
        );
        return view('pengrajin.product.tambah', $data);
    }

    public function store(Request $request)
    {
        //menyimpan produk ke database
        $idUser = auth()->user()->id;

        if ($request->file('image')) {
            //simpan foto produk yang di upload ke direkteri public/storage/imageproduct
            $file = $request->file('image')->store('imageproduct', 'public');

            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stok' => $request->stok,
                'weigth' => $request->weigth,
                'categories_id' => $request->categories_id,
                'pengrajin_id' => $idUser,
                'image'          => $file
            ]);

            return redirect()->route('pengrajin.product')->with('status', 'Berhasil Menambah Produk Baru');
        }
    }

    public function edit($id)
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notif();

        //menampilkan form edit
        //dan mengambil data produk sesuai id dari parameter
        $data = array(
            'product' => Product::findOrFail($id),
            'categories' => Categories::all(),
            'notif' => $notifikasi,
            'totalPem' => $notifikasi[4]
        );
        return view('pengrajin.product.edit', $data);
    }

    public function update($id, Request $request)
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notif();

        $data['notif'] = $notifikasi;
        $data['totalPem'] = $notifikasi[4];

        //ambil data dulu sesuai parameter $Id
        $prod = Product::findOrFail($id);

        // Lalu update data nya ke database
        if ($request->file('image')) {

            Storage::delete('public/' . $prod->image);
            $file = $request->file('image')->store('imageproduct', 'public');
            $prod->image = $file;
        }

        $prod->name = $request->name;
        $prod->description = $request->description;
        $prod->price = $request->price;
        $prod->weigth = $request->weigth;
        $prod->categories_id = $request->categories_id;
        $prod->stok = $request->stok;
        $prod->save();

        return redirect()->route('pengrajin.product', $data)->with('status', 'Berhasil Mengubah Kategori');
    }

    public function delete($id)
    {
        //mengahapus produk
        $prod = Product::findOrFail($id);
        Product::destroy($id);
        Storage::delete('public/' . $prod->image);
        return redirect()->route('pengrajin.product')->with('status', 'Berhasil Mengahapus Produk');
    }
}
