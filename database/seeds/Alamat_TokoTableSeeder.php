<?php

use Illuminate\Database\Seeder;
use App\Alamat;

class Alamat_TokoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['city_id' => '325','detail'=>'Simbatan Wetan, Simbatan, Kec. Nguntoronadi, Kabupaten Magetan, Jawa Timur 63383']
        ];  
        Alamat_Toko::insert($data);
    }
}
