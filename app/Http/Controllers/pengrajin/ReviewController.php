<?php

namespace App\Http\Controllers\pengrajin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\ResponseReview;

class ReviewController extends Controller
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
        $reviews = DB::table('reviews')
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->join('order', 'order.id', '=', 'reviews.order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('products.name as product_name', 'users.id as user_id', 'users.name as user_name', 'reviews.*', 'reviews.review as penilaian')
            ->where('products.pengrajin_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $data = array(
            'reviews' => $reviews,
            'notif' => $notifikasi,
            'totalPem' => $notifikasi[4]
        );

        // return $reviews;
        return view('pengrajin.penilaian.tanggapan', $data);
    }

    public function detail($id)
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notif();

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
            'responseReview' => $responseReview,
            'notif' => $notifikasi,
            'totalPem' => $notifikasi[4]
        );
        // return $review;
        return view('pengrajin.penilaian.detail', $data);
    }
    public function postTanggapanPenilaian(Request $request)
    {
        // memanggil fungsi notif dari helpers.php
        $notifikasi = notif();
        
        $reviews = DB::table('reviews')
            ->select('reviews.*')
            ->where('reviews.id', $request->reviewId)
            ->first();
        if ($reviews == null) {
            return redirect()->route('pengrajin.review.detail', ['id' => $request->reviewId]);
        }
        $idUser = auth()->user()->id;

        ResponseReview::create([
            'tanggapan' => $request->tanggapan,
            'review_id' => $request->reviewId,
            'user_id' => $idUser,
        ]);
        return redirect()->route('pengrajin.review.detail', ['id' => $request->reviewId])->with('status', 'Berhasil membuat tanggapan');
    }
}
