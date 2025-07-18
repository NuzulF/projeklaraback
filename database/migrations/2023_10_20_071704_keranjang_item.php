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
        Schema::create('keranjang_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keranjang_id')->nullable();
            $table->unsignedBigInteger('destinasi_id')->nullable();
            $table->unsignedBigInteger('paket_destinasi_id')->nullable();
            $table->unsignedBigInteger('paket_wahana_id')->nullable();
            $table->string('kode_tiket')->nullable();
            $table->boolean('status_tiket')->default(false);
            $table->timestamps();

            $table->foreign('keranjang_id')
                ->references('id')
                ->on('keranjang')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('destinasi_id')
                ->references('id')
                ->on('destinasi')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('paket_destinasi_id')
                ->references('id')
                ->on('paket')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('paket_wahana_id')
                ->references('id')
                ->on('paket')
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
        Schema::dropIfExists('keranjang_item');
    }
};
