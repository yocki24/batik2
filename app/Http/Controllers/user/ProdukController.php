<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index()
    {
        //menampilkan data produk yang dijoin dengan table kategori
        //kemudian dikasih paginasi 9 data per halaman nya
        $kat = DB::table('categories')
            ->join('products', 'products.categories_id', '=', 'categories.id')
            ->select(DB::raw('count(products.categories_id) as jumlah, categories.*'))
            ->groupBy('categories.id')
            ->get();
        $prods = Product::with(['reviews'])
            ->leftJoin('reviews', 'reviews.product_id', '=', 'products.id')
            ->select([
                'products.*',
                DB::raw('AVG(reviews.star) as ratings_average')
            ])
            ->groupBy('products.id')
            ->paginate(9);
        $data = array(
            'produks' => $prods,
            'categories' => $kat
        );
        return view('user.produk', $data);
    }
    public function detail($id)
    {
        //mengambil detail produk
        $product = Product::with(['reviews'])
            ->leftJoin('reviews', 'reviews.product_id', '=', 'products.id')
            ->select([
                'products.*',
                DB::raw('AVG(reviews.star) as ratings_average')
            ])
            ->where('products.id', $id)
            ->first();
        $data = array(
            'produk' => $product
        );
        return view('user.produkdetail', $data);
    }

    public function cari(Request $request)
    {
        //mencari produk yang dicari user
        $prod  = Product::where('name', 'like', '%' . $request->cari . '%')->paginate(9);
        $total = Product::where('name', 'like', '%' . $request->cari . '%')->count();
        $data  = array(
            'produks' => $prod,
            'cari' => $request->cari,
            'total' => $total
        );
        return view('user.cariproduk', $data);
    }
}
