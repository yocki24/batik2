<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LocationCekOngkir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cekongkir', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('province_id');
            $table->string('nama_province');
            $table->unsignedBigInteger('city_id');
            $table->string('nama_cities');
            $table->string('nama_couriers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provinces');
    }
}
