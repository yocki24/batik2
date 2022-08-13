<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user = new \App\User;
        $user->name = "administrator";
        $user->email = "admin@gmail.com";
        $user->password = \Hash::make("rahasia");
        $user->roles ="Administrator";

        $user->save();

        $this->command->info("Admin berhasil ditambahkan");

        $user = new \App\User;
        $user->name = "ketua";
        $user->email = "ketua@gmail.com";
        $user->password = \Hash::make("123456");
        $user->roles ="Ketua";

        $user->save();

        $this->command->info("ketua berhasil ditambahkan");

        $user = new \App\User;
        $user->name = "pengrajin";
        $user->email = "pengrajin@gmail.com";
        $user->password = \Hash::make("p12345");
        $user->roles ="Pengrajin";

        $user->save();

        $this->command->info("pengrajin berhasil ditambahkan");
        
    }
}