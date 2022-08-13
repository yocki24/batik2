<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('subtotal');
            $table->string('no_resi')->nullable();
            $table->unsignedBigInteger('status_order_id');
            $table->string('metode_pembayaran');
            $table->integer('ongkir');
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
        Schema::dropIfExists('order');
    }
}
