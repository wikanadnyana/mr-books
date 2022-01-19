<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaksi_id')->unsigned();
            $table->bigInteger('buku_id')->unsigned();
            $table->integer('quantity');
            $table->double('total_harga');
            $table->timestamps();

            $table->foreign('transaksi_id')->references('id')->on('transaksis')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('buku_id')->references('id')->on('bukus')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transaksis');
    }
}
