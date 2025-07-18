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
        Schema::create('transaksi_keranjang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id')->nullable();
            $table->unsignedBigInteger('keranjang_id')->nullable();
            $table->timestamps();
            $table->foreign('transaksi_id')
                ->references('id')
                ->on('transaksi')
                ->onUpdate('cascade')
                ->onDelete('restrict');
                
            $table->foreign('keranjang_id')
                ->references('id')
                ->on('keranjang')
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
        Schema::dropIfExists('transaksi_keranjang');
    }
};
