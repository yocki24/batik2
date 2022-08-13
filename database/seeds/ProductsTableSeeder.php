<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Batik Ciprat Obat Nyamuk','description'=>'bahan : primisima ukuran: 2.15 x 1.10
            pewarna: sintetis','image'=>'gambar 2.jpg','price' => '150000', 'weigth' => '2.15', 'categories_id' => '3', 'stok' => '50'],
            ['name' => 'Batik Ciprat Kecubung','description'=>'bahan : primisima ukuran: 2.15 x 1.10
            pewarna: sintetis','image'=>'gambar 1.jpg','price' => '150000', 'weigth' => '2.15', 'categories_id' => '5', 'stok' => '30'],
            ['name' => 'Batik Ciprat Motif Bunga tulip','description'=>'Batik Ciprat motif bunga tulip
            Bahan   : katun primisima Ukuran :105cm x 220cm','image'=>'gambar 7.png','price' => '150000', 'weigth' => '105', 'categories_id' => '5', 'stok' => '80'],
            ['name' => 'Batik Pelangi Coret','description'=>'Batik Ciprat Desa Simbatan yang dibuat oleh para penyandang disabilitas

            Batik Ciprat motif pelangi coret
            Bahan   : katun primisima
            Ukuran  :105cm x 220cm','image'=>'gambar 12.png','price' => '150000', 'weigth' => '105', 'categories_id' => '3', 'stok' => '20'],
            ['name' => 'Batik Tumpul Jumput','description'=>'Batik Ciprat Desa Simbatan yang dibuat oleh para penyandang disabilitas

            Batik Ciprat motif batik Tumpul Jumput
            Bahan   : katun primisima
            Ukuran  :105cm x 220cm','image'=>'gambar 13.png','price' => '150000 - 400000', 'weigth' => '105', 'categories_id' => '5', 'stok' => '15'],
            ['name' => 'Batik Gelombang Laut','description'=>'Batik Ciprat Desa Simbatan yang dibuat oleh para penyandang disabilitas

            Batik Ciprat motif Gelombang Laut
            Bahan   : katun jepang
            Ukuran  :105cm x 220cm','image'=>'gambar 14.png','price' => '150000 - 200000', 'weigth' => '105', 'categories_id' => '4', 'stok' => '30'],
            ['name' => 'Batik Ciprat Morat - marit','description'=>'Batik Ciprat Desa Simbatan yang dibuat oleh para penyandang disabilitas

            Batik Ciprat motif morat - marit
            Bahan   : katun Jepang
            Ukuran  :105cm x 220cm','image'=>'gambar 15.png','price' => '200000', 'weigth' => '105', 'categories_id' => '2', 'stok' => '43'],
            ['name' => 'Batik Ciprat Bintang','description'=>'Motif Ciprat Bintang
            Primisima
            Ukuran 2,15 x 1,10
            Ready stok
            160rb','image'=>'batik_bintang.png','price' => '160.000', 'weigth' => '2.15', 'categories_id' => '2', 'stok' => '100'],
            ['name' => 'Batik Ciprat Motif Dong Telo','description'=>'Motif Dong Telo
            Ready stok
            Ukuran 2,15 x 1,10
            Harga 200rb','image'=>'batik_dongtelo.png','price' => '200.000', 'weigth' => '2.15', 'categories_id' => '5', 'stok' => '90'],
            ['name' => 'Batik Motif Kembang Krokot','description'=>'Motif Terbaru Kembang Krokot
            Ready stok
            Ukuran 2,15 x 1,10
            Harga 150rb','image'=>'batik_kembangkrokot.png','price' => '150000', 'weigth' => '2.15', 'categories_id' => '5', 'stok' => '30'],
            ['name' => 'Batik Motif Cahaya Pelangi','description'=>'Motif cahaya pelangi
            Primisima
            Ukuran 2,15 x 1,10
            Harga 160rb','image'=>'cahaya_pelangi.png','price' => '160.000', 'weigth' => '2.15', 'categories_id' => '1', 'stok' => '50'],
            ['name' => 'Batik MOtif Ciprat Anyam','description'=>'Motif ciprat anyam
            Ukuran 2,15 x 1,10
            Kain Primisima
            Ready stok','image'=>'ciprat_anyaman.png','price' => '160.000', 'weigth' => '2.15', 'categories_id' => '2', 'stok' => '30'],
            ['name' => 'Batik Ciprat Motif Balok','description'=>'Motif ciprat balok
            Primisima
            Ukuran 2,15 x 1,10
            Ready stok
            Bisa reques warna','image'=>'ciprat_balok.png','price' => '160.000', 'weigth' => '2.15', 'categories_id' => '6', 'stok' => '29'],
            ['name' => 'Batik Ciprat Rumput','description'=>'Motif ciprat Rumput
            Ukuran 2,15 x 1,10
            Ready stok
            150rb
            Bisa reques warna','image'=>'ciprat_rumput.png','price' => '150000', 'weigth' => '2.15', 'categories_id' => '1', 'stok' => '10'],
            ['name' => 'Batik Ciprat Motif Tumpal Jumput','description'=>'Motif Tumpal jumput berbagai warna ready 
            140rb
            Bisa reques warna','image'=>'tumpal_jumput.png','price' => '140.000', 'weigth' => '2.15', 'categories_id' => '6', 'stok' => '60'],
            ['name' => 'Batik Ciprat Motif Pelangi Tetes','description'=>'Motif Pelangi Tetes berbagai warna ready stok
            Bisa reques warna','image'=>'pelangi_tetes.png','price' => '150000', 'weigth' => '2.15', 'categories_id' => '2', 'stok' => '47'],
            ['name' => 'Batik Ciprat Motif Layangan','description'=>'Motif Layangan
            Ukuran 2,15 x 1,10
            Primisima
            Harga 160rb
            Ready stok','image'=>'motif_layangan.png','price' => '160.000', 'weigth' => '2.15', 'categories_id' => '5', 'stok' => '20'],
            ['name' => 'Batik Ciprat Motif Prapatan','description'=>'Motif Prapatan
            Harga 160rb
            Ukuran 2,15 x 1,10
            Warna bisa memilih
            Ready stok kain primisima','image'=>'motif_prapatan.png','price' => '160.000', 'weigth' => '2.15', 'categories_id' => '6', 'stok' => '20'],
            ['name' => 'Batik Ciprat Motif Rubik','description'=>'Motif rubik
            Ukuran 2,15 x 1,10
            Primisima
            Harga 160rb
            Ready stok','image'=>'motif_rubik.png','price' => '160.000', 'weigth' => '2.15', 'categories_id' => '3', 'stok' => '30'],
            ['name' => 'Batik Ciprat Motif Kotak','description'=>'Motif kotak
            Ready stok
            Ukuran 2,15 x 1,10
            Harga 160rb
            Bisa reques warna','image'=>'motif_kotak.png','price' => '160.000', 'weigth' => '2.15', 'categories_id' => '3', 'stok' => '35'],
            ['name' => 'Batik Ciprat Motif Bunga Matahari','description'=>'Motif Bunga Matahari
            Ready stok
            Ukuran 2,15 x 1,10
            Harga 150rb
            Bisa reques warna','image'=>'motif_bungamatahari.png','price' => '150000', 'weigth' => '2.15', 'categories_id' => '6', 'stok' => '40'],
        ['name' => 'Batik Ciprat Motif Cendol Dawet','description'=>'Motif Terbaru Cendol Dawet 
        Ready stok
        Ukuran 2,15 x 1,10
        Harga 150rb
        Bisa reques warna','image'=>'krokot.png','price' => '150.000', 'weigth' => '2.15', 'categories_id' => '5', 'stok' => '15'],
        ['name' => 'Batik Ciprat Bintang','description'=>'Motif Ciprat Bintang
        Primisima
        Ukuran 2,15 x 1,10
        Ready stok
        160rb','image'=>'batik_bintang.png','price' => '160.000', 'weigth' => '2.15', 'categories_id' => '2', 'stok' => '100'],
        ['name' => 'Batik Motif Kembang Krokot','description'=>'Motif Terbaru Kembang Krokot
        Ready stok
        Ukuran 2,15 x 1,10
        Harga 150rb','image'=>'batik_kembangkrokot.png','price' => '150000', 'weigth' => '2.15', 'categories_id' => '5', 'stok' => '30'],
        ];
        Product::insert($data);
    }
}
