<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksiTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksi_temps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('buku_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('quantity');
            $table->double('total_harga');            
            $table->timestamps();

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
        Schema::dropIfExists('detail_transaksi_temps');
    }
}
