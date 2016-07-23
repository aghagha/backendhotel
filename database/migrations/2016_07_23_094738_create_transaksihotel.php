<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksihotel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksihotel',function(Blueprint $table){
            $table->increments('id');
            $table->string('booktime');
            $table->string('bookingnumber');
            $table->string('namatamu');
            $table->string('hotel');
            $table->string('kamar');
            $table->string('checkin');
            $table->string('checkout');
            $table->string('totalharga');
            $table->string('status');
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
        Schema::drop('transaksihotel');
    }
}
