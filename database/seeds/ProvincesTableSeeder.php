<?php

use Illuminate\Database\Seeder;
use App\Province;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['province_id' => '1', 'nama_province' => 'Aceh'],
            ['province_id' => '2', 'nama_province' => 'Sumatra Utara'],
            ['province_id' => '3', 'nama_province' => 'Sumatra Barat'],
            ['province_id' => '4', 'nama_province' => 'Riau'],
            ['province_id' => '5', 'nama_province' => 'Jambi'],
            ['province_id' => '6', 'nama_province' => 'Sumatera Selatan'],
            ['province_id' => '7', 'nama_province' => 'Bengkulu'],
            ['province_id' => '8', 'nama_province' => 'Lampung'],
            ['province_id' => '9', 'nama_province' => 'Kepulauan Bangka Belitung'],
            ['province_id' => '10', 'nama_province' => 'Kepulauan Riau'],
            ['province_id' => '11', 'nama_province' => 'DKI Jakarta'],
            ['province_id' => '12', 'nama_province' => 'Jawa Barat'],
            ['province_id' => '13', 'nama_province' => 'Jawa Tengah'],
            ['province_id' => '14', 'nama_province' => 'DI Yogyakarta'],
            ['province_id' => '15', 'nama_province' => 'Jawa Timur'],
            ['province_id' => '16', 'nama_province' => 'Banten'],
            ['province_id' => '17', 'nama_province' => 'Bali'],
            ['province_id' => '18', 'nama_province' => 'Nusa Tenggara Barat'],
            ['province_id' => '19', 'nama_province' => 'Nusa Tenggara Timur'],
            ['province_id' => '20', 'nama_province' => 'Kalimantan Barat'],
            ['province_id' => '21', 'nama_province' => 'Kalimantan Tengah'],
            ['province_id' => '22', 'nama_province' => 'Kalimantan Selatan'],
            ['province_id' => '23', 'nama_province' => 'Kalimantan Timur'],
            ['province_id' => '24', 'nama_province' => 'Kalimantan Utara'],
            ['province_id' => '25', 'nama_province' => 'Sulawesi Utara'],
            ['province_id' => '26', 'nama_province' => 'Sulawesi Tengah'],
            ['province_id' => '27', 'nama_province' => 'Sulawesi Selatan'],
            ['province_id' => '28', 'nama_province' => 'Sulawesi Tenggara'],
            ['province_id' => '29', 'nama_province' => 'Gorontalo'],
            ['province_id' => '30', 'nama_province' => 'Sulawesi Barat'],
            ['province_id' => '31', 'nama_province' => 'Maluku'],
            ['province_id' => '32', 'nama_province' => 'Maluku Utara'],
            ['province_id' => '33', 'nama_province' => 'Papua'],
            ['province_id' => '34', 'nama_province' => 'Papua Barat'],
        ];
        Province::insert($data);
    }
}
