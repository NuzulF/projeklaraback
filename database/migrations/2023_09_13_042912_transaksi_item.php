<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('destinasi_id')->nullable();
            $table->unsignedBigInteger('wahana_id')->nullable();
            $table->unsignedBigInteger('paket_id')->nullable();
            $table->unsignedBigInteger('transaksi_id');
            $table->integer('jumlah_tiket');
            $table->date('tanggal_kunjungan');
            $table->timestamps();

            $table->foreign('destinasi_id')
                ->references('id')
                ->on('destinasi')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('wahana_id')
                ->references('id')
                ->on('wahana')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('paket_id')
                ->references('id')
                ->on('paket')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('transaksi_id')
                ->references('id')
                ->on('transaksi')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_item');
    }
};
