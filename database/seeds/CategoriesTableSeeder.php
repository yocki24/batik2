<?php

use Illuminate\Database\Seeder;
use App\Categories;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Original Ciprat'],
            ['name' => 'Lurikan'],
            ['name' => 'Meteor'],
            ['name' => 'Gepyokan'],
            ['name' => 'Kombinasi Canting & Ciprat 	'],
            ['name' => 'Jumputan'],
        ];
        Categories::insert($data);
    }
}

