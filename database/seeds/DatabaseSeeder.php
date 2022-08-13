<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UserSeeder::class);
        //$this->call(CouriersTableSeeder::class);
       // $this->call(LocationsTableSeeder::class);
        //$this->call(OrderStatusSeeder::class);
        //$this->call(RekeningTableSeeder::class);
        //$this->call(ProductsTableSeeder::class);
        //$this->call(ProvincesTableSeeder::class);
        //$this->call(CategoriesTableSeeder::class);
        //$this->call(CitiesTableSeeder::class);
        $this->call(Alamat_TokoTableSeeder::class);
    }
}
