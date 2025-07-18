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
        Schema::create('reschedule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_aduan_id');
            $table->string('order_id');
            $table->unsignedBigInteger('keranjang_id');
            $table->unsignedBigInteger('user_id');
            $table->date('tanggalAwal');
            $table->date('tanggalBaru');
            $table->string('detail');
            $table->string('lampiran')->nullable();
            $table->enum('status', ['pending', 'approve', 'reject'])->default('pending');
            $table->timestamps();

            $table->foreign('jenis_aduan_id')
                ->references('id')
                ->on('jenis_aduan')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('order_id')
                ->references('order_id')
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
        Schema::dropIfExists('reschedule');
    }
};
