<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/','user\WelcomeController@index')->name('home');
Route::get('/home','user\WelcomeController@index')->name('home2');
Route::get('/produk','user\ProdukController@index')->name('user.produk');
Route::get('/produk/cari','user\ProdukController@cari')->name('user.produk.cari');
Route::get('/kategori/{id}','KategoriController@produkByKategori')->name('user.kategori');
Route::get('/produk/{id}','user\ProdukController@detail')->name('user.produk.detail');
Route::get('/ongkir', 'CheckOngkirController@index');
Route::post('/ongkir', 'CheckOngkirController@check_ongkir');
Route::get('/cities/{province_id}', 'CheckOngkirController@getCities');
Route::get('/tentang', 'TentangController@about');

Route::get('/register-pengrajin', 'Auth\RegisterController@registerPengrajin')->name('register.pengrajin');

Route::get('/pelanggan',function(){
    return 'Pelanggan';
});

Route::group(['middleware' => 'auth'],function(){     
    Route::get('/admin','DashboardController@index')->name('admin.dashboard');
    Route::get('/pengaturan/alamat','admin\PengaturanController@aturalamat')->name('admin.pengaturan.alamat');
    Route::get('/pengaturan/ubahalamat/{id}','admin\PengaturanController@ubahalamat')->name('admin.pengaturan.ubahalamat');
    Route::get('/pengaturan/alamat/getcity/{id}','admin\PengaturanController@getCity')->name('admin.pengaturan.getCity');
    Route::post('pengaturan/simpanalamat','admin\PengaturanController@simpanalamat')->name('admin.pengaturan.simpanalamat');
    Route::post('pengaturan/updatealamat/{id}','admin\PengaturanController@updatealamat')->name('admin.pengaturan.updatealamat');

    Route::get('/admin/transaksi','admin\TransaksiController@index')->name('admin.transaksi');
    Route::get('/admin/transaksi/perludicek','admin\TransaksiController@perludicek')->name('admin.transaksi.perludicek');
    Route::get('/admin/transaksi/perludikirim','admin\TransaksiController@perludikirim')->name('admin.transaksi.perludikirim');
    Route::get('/admin/transaksi/dikirim','admin\TransaksiController@dikirim')->name('admin.transaksi.dikirim');
    Route::get('/admin/transaksi/detail/{id}','admin\TransaksiController@detail')->name('admin.transaksi.detail');
    Route::get('/admin/transaksi/konfirmasi/{id}','admin\TransaksiController@konfirmasi')->name('admin.transaksi.konfirmasi');
    Route::post('/admin/transaksi/inputresi/{id}','admin\TransaksiController@inputresi')->name('admin.transaksi.inputresi');
    Route::get('/admin/transaksi/selesai','admin\TransaksiController@selesai')->name('admin.transaksi.selesai');
    Route::get('/admin/transaksi/dibatalkan','admin\TransaksiController@dibatalkan')->name('admin.transaksi.dibatalkan');

    Route::get('/admin/rekening','admin\RekeningController@index')->name('admin.rekening');
    Route::get('/admin/rekening/edit/{id}','admin\RekeningController@edit')->name('admin.rekening.edit');
    Route::get('/admin/rekening/tambah','admin\RekeningController@tambah')->name('admin.rekening.tambah');
    Route::post('/admin/rekening/store','admin\RekeningController@store')->name('admin.rekening.store');
    Route::get('/admin/rekening/delete/{id}','admin\RekeningController@delete')->name('admin.rekening.delete');
    Route::post('/admin/rekening/update/{id}','admin\RekeningController@update')->name('admin.rekening.update');
    
    Route::get('/admin/pelanggan','admin\PelangganController@index')->name('admin.pelanggan');

    Route::get('/admin/reports/sales/yearly', 'admin\ReportsController@index')->name('reports.sales.yearly');
    Route::get('/admin/reports/sales/monthly', 'admin\ReportsController@monthly')->name('reports.sales.monthly');
    Route::get('/admin/reports/sales/daily', 'admin\ReportsController@daily')->name('reports.sales.daily');

    Route::get('/admin/product-review', 'admin\ReviewController@index')->name('admin.review');
    Route::get('/admin/product-review/{id}', 'admin\ReviewController@detail')->name('admin.review.detail');

    Route::post('/keranjang/simpan','user\KeranjangController@simpan')->name('user.keranjang.simpan');
    Route::get('/keranjang','user\KeranjangController@index')->name('user.keranjang');
    Route::post('/keranjang/update','user\KeranjangController@update')->name('user.keranjang.update');
    Route::get('/keranjang/delete/{id}','user\KeranjangController@delete')->name('user.keranjang.delete');
    Route::get('/alamat','user\AlamatController@index')->name('user.alamat');
    Route::get('/getcity/{id}','user\AlamatController@getCity')->name('user.alamat.getCity');
    Route::post('/alamat/simpan','user\AlamatController@simpan')->name('user.alamat.simpan');
    Route::post('/alamat/update/{id}','user\AlamatController@update')->name('user.alamat.update');
    Route::get('/alamat/ubah/{id}','user\AlamatController@ubah')->name('user.alamat.ubah');
    Route::get('/checkout','user\CheckoutController@index')->name('user.checkout');
    Route::post('/order/simpan','user\OrderController@simpan')->name('user.order.simpan');
    Route::get('/order/sukses','user\OrderController@sukses')->name('user.order.sukses');
    Route::get('/order','user\OrderController@index')->name('user.order');
    Route::get('/order/detail/{id}','user\OrderController@detail')->name('user.order.detail');
    Route::get('/order/pesananditerima/{id}','user\OrderController@pesananditerima')->name('user.order.pesananditerima');
    Route::get('/order/pesanandibatalkan/{id}','user\OrderController@pesanandibatalkan')->name('user.order.pesanandibatalkan');
    Route::get('/order/pembayaran/{id}','user\OrderController@pembayaran')->name('user.order.pembayaran');
    Route::post('/order/kirimbukti/{id}','user\OrderController@kirimbukti')->name('user.order.kirimbukti');
    Route::get('/order/penilaian/{id}/{prodId}','user\OrderController@penilaian')->name('user.order.rate');
    Route::post('/order/penilaian','user\OrderController@postPenilaian')->name('user.order.rate.submit');
    Route::get(' /user/posts', 'PostController@posts')->name('posts');
    Route::post('/user/posts', 'PostController@postPost')->name('posts.post');
    Route::get('/user/posts/{id}', 'PostController@show')->name('posts.show');
    Route::get('/ongkir', 'CheckOngkirController@index');
    Route::post('/ongkir', 'CheckOngkirController@check_ongkir');
    Route::get('/cities/{province_id}', 'CheckOngkirController@getCities');

    Route::get('/user/product-review/{id}', 'user\OrderController@detailReview')->name('user.review.detail');


  
    Route::get('/pengrajin','DashboardpengrajinController@index')->name('pengrajin.dashboardpengrajin');
    Route::get('/pengrajin/categories','pengrajin\CategoriesController@index')->name('pengrajin.categories');
    Route::get('/pengrajin/categories/tambah','pengrajin\CategoriesController@tambah')->name('pengrajin.categories.tambah');
    Route::post('/pengrajin/categories/store','pengrajin\CategoriesController@store')->name('pengrajin.categories.store');
    Route::post('/pengrajin/categories/update/{id}','pengrajin\CategoriesController@update')->name('pengrajin.categories.update');
    Route::get('/pengrajin/categories/edit/{id}','pengrajin\CategoriesController@edit')->name('pengrajin.categories.edit');
    Route::get('/pengrajin/categories/delete/{id}','pengrajin\CategoriesController@delete')->name('pengrajin.categories.delete');

    Route::get('/pengrajin/product','pengrajin\ProductController@index')->name('pengrajin.product');
    Route::get('/pengrajin/product/tambah','pengrajin\ProductController@tambah')->name('pengrajin.product.tambah');
    Route::post('/pengrajin/product/store','pengrajin\ProductController@store')->name('pengrajin.product.store');
    Route::get('/pengrajin/product/edit/{id}','pengrajin\ProductController@edit')->name('pengrajin.product.edit');
    Route::get('/pengrajin/product/delete/{id}','pengrajin\ProductController@delete')->name('pengrajin.product.delete');
    Route::post('/pengrajin/product/update/{id}','pengrajin\ProductController@update')->name('pengrajin.product.update');

    Route::get('/pengrajin/transaksi','pengrajin\TransaksiController@index')->name('pengrajin.transaksi');
    Route::get('/pengrajin/transaksi/perludicek','pengrajin\TransaksiController@perludicek')->name('pengrajin.transaksi.perludicek');
    Route::get('/pengrajin/transaksi/perludikirim','pengrajin\TransaksiController@perludikirim')->name('pengrajin.transaksi.perludikirim');
    Route::get('/pengrajin/transaksi/dikirim','pengrajin\TransaksiController@dikirim')->name('pengrajin.transaksi.dikirim');
    Route::get('/pengrajin/transaksi/detail/{id}','pengrajin\TransaksiController@detail')->name('pengrajin.transaksi.detail');
    Route::get('/pengrajin/transaksi/konfirmasi/{id}','pengrajin\TransaksiController@konfirmasi')->name('pengrajin.transaksi.konfirmasi');
    Route::post('/pengrajin/transaksi/inputresi/{id}','pengrajin\TransaksiController@inputresi')->name('pengrajin.transaksi.inputresi');
    Route::get('/pengrajin/transaksi/selesai','pengrajin\TransaksiController@selesai')->name('pengrajin.transaksi.selesai');
    Route::get('/pengrajin/transaksi/dibatalkan','pengrajin\TransaksiController@dibatalkan')->name('pengrajin.transaksi.dibatalkan');
     Route::get('/pengrajin/transaksi/detail_konfirmasi/{id}','pengrajin\TransaksiController@detail')->name('pengrajin.transaksi.detail_konfirmasi');
      Route::get('/pengrajin/transaksi/konfirmasi_pesanan/{id}','pengrajin\TransaksiController@konfirmasi_pesanan')->name('pengrajin.transaksi.konfirmasi_pesanan');
      Route::get('/pengrajin/transaksi/batalkan_pesanan/{id}','pengrajin\TransaksiController@batalkan_pesanan')->name('pengrajin.transaksi.batalkan_pesanan');

    Route::get('/pengrajin/product-review', 'pengrajin\ReviewController@index')->name('pengrajin.review');
    Route::get('/pengrajin/product-review/{id}', 'pengrajin\ReviewController@detail')->name('pengrajin.review.detail');
    Route::post('/pengrajin/tanggapan-review', 'pengrajin\ReviewController@postTanggapanPenilaian')->name('pengrajin.review.tanggapan');

    Route::get(' /user/posts', 'PostController@posts')->name('posts');
    Route::post('/user/posts', 'PostController@postPost')->name('posts.post');
    Route::get('/user/posts/{id}', 'PostController@show')->name('posts.show');

    Route::get('/ketua','DashboardketuaController@index')->name('ketua.dashboardketua');
    Route::get('/ketua/reports/sales/yearly', 'ketua\ReportsController@index')->name('ketua.reports.sales.yearly');
    Route::get('/ketua/reports/sales/monthly', 'ketua\ReportsController@monthly')->name('ketua.reports.sales.monthly');
    Route::get('/ketua/reports/sales/daily', 'ketua\ReportsController@daily')->name('ketua.reports.sales.daily');
    
    Route::get('/ketua/reports/pdf/sales', [App\Http\Controllers\ketua\ReportsController::class, 'createPDFyearly'])->name('sales.yearly.pdf');
    Route::get('/ketua/reports/pdf/sales/monthly', [App\Http\Controllers\ketua\ReportsController::class, 'createPDFmonthly'])->name('sales.monthly.pdf');
    Route::get('/ketua/reports/pdf/sales/daily', [App\Http\Controllers\ketua\ReportsController::class, 'createPDFdaily'])->name('sales.daily.pdf');


});