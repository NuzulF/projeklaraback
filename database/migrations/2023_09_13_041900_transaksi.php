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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->string('nama_pemesan');
            $table->string('no_telp_pemesan');
            $table->integer('total_pembayaran');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jenis_pembayaran_id');
            $table->enum('status', [0, 1]);
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('jenis_pembayaran_id')
            ->references('id')
            ->on('jenis_pembayaran')
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
        Schema::dropIfExists('transaksi');
    }
};
