<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->bigInteger('kategori_id')->unsigned();
            $table->bigInteger('supplier_id')->unsigned();
            $table->text('deskripsi');
            $table->string('kode');
            $table->string('judul');
            $table->integer('stok');
            $table->integer('harga');
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategoris')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')
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
        Schema::dropIfExists('bukus');
    }
}
