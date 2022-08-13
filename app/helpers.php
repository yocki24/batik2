<?php

use Illuminate\Support\Facades\DB;

function month_date_array($year, $month){
    $days= cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $array = array();
    for ($i=1; $i <= $days; $i++) {
        $date = $i.'-'.$month.'-'. $year;
        $Store = date('l\, d-m-Y', strtotime($date));
        $array[] = $Store;
    }
    return $array;
}

function get_months(){
    $arr = array();
    for ($m = 1; $m <= 12; $m++) {
        $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
        array_push($arr, $month);
    }
    return $arr;
}

function format_rp($number){
    return 'Rp'.number_format($number, 2, ',', '.');

}

function notif()
    {
        // untuk notifikasi pesanan baru
        $order1 = DB::table('detail_order')
            ->join('order', 'order.id', '=', 'detail_order.order_id')
            ->join('products', 'products.id', '=', 'detail_order.product_id')
            ->select(DB::raw('distinct detail_order.*', 'order.*', 'products.*'))
            ->where('order.status_order_id', 1)
            ->where('products.pengrajin_id', auth()->user()->id)
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
            ->where('products.pengrajin_id', auth()->user()->id)
            ->where('order.status_order_id', 4)
            ->groupBy('order.id')
            ->get();

        // untuk notifikasi barang dikirim
        $order4 = DB::table('detail_order')
            ->join('order', 'order.id', '=', 'detail_order.order_id')
            ->join('products', 'products.id', '=', 'detail_order.product_id')
            ->select(DB::raw('distinct detail_order.*', 'order.*', 'products.*'))
            ->where('products.pengrajin_id', auth()->user()->id)
            ->where('order.status_order_id', 5)
            ->groupBy('order.id')
            ->get();

        $notif1 = count($order1);
        $notif2 = count($order2);
        $notif3 = count($order3);
        $notif4 = count($order4);
        $totalPem = $notif1 + $notif2 + $notif3 + $notif4;
        return [$notif1, $notif2, $notif3, $notif4, $totalPem];

        
    }

    function notifAdmin()
    {
        // untuk notifikasi pesanan baru
        $order1 = DB::table('detail_order')
            ->join('order', 'order.id', '=', 'detail_order.order_id')
            ->join('products', 'products.id', '=', 'detail_order.product_id')
            ->select(DB::raw('distinct detail_order.*', 'order.*', 'products.*'))
            ->where('order.status_order_id', 1)
            ->groupBy('order.id')
            ->get();

        // untuk notifikasi perlu dicek
        $order2 = DB::table('detail_order')
            ->join('order', 'order.id', '=', 'detail_order.order_id')
            ->join('products', 'products.id', '=', 'detail_order.product_id')
            ->select(DB::raw('distinct detail_order.*', 'order.*', 'products.*'))
            ->whereIn('order.status_order_id', [2, 3])
            ->groupBy('order.id')
            ->get();

        // untuk notifikasi perlu dikirim
        $order3 = DB::table('detail_order')
            ->join('order', 'order.id', '=', 'detail_order.order_id')
            ->join('products', 'products.id', '=', 'detail_order.product_id')
            ->select(DB::raw('distinct detail_order.*', 'order.*', 'products.*'))
            ->where('order.status_order_id', 4)
            ->groupBy('order.id')
            ->get();

        // untuk notifikasi barang dikirim
        $order4 = DB::table('detail_order')
            ->join('order', 'order.id', '=', 'detail_order.order_id')
            ->join('products', 'products.id', '=', 'detail_order.product_id')
            ->select(DB::raw('distinct detail_order.*', 'order.*', 'products.*'))
            ->where('order.status_order_id', 5)
            ->groupBy('order.id')
            ->get();

        $notif1 = count($order1);
        $notif2 = count($order2);
        $notif3 = count($order3);
        $notif4 = count($order4);
        $totalPem = $notif1 + $notif2 + $notif3 + $notif4;
        return [$notif1, $notif2, $notif3, $notif4, $totalPem];

    }