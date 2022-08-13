<?php

use Illuminate\Database\Seeder;
use App\Courier;
class CouriersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['code' => 'jne','nama_couriers' => 'JNE'],
            ['code' => 'pos','nama_courierse' => 'POS'],
            ['code' => 'tiki','nama_couriers' => 'TIKI'],
        ];
        Courier::insert($data);
    }
}
