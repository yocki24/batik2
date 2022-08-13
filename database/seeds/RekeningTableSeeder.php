<?php

use Illuminate\Database\Seeder;
use App\Rekening;
class RekeningTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['bank_name' => 'BRI','atas_nama'=>'Deni Mustika','no_rekening'=>'0341-01-000-743xxx'],
            ['bank_name' => 'Mandiri','atas_nama'=>'Saktiyaningrum','no_rekening'=>'111-00-045xx-xx']
        ];
        Rekening::insert($data);
    }
}
