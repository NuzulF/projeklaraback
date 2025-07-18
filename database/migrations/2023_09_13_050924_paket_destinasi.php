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
        Schema::create('paket_destinasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('destinasi_id');
            $table->unsignedBigInteger('paket_id');
            $table->timestamps();

            $table->foreign('paket_id')
                ->references('id')
                ->on('paket')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('destinasi_id')
                ->references('id')
                ->on('destinasi')
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
        Schema::dropIfExists('paket_destinasi');
    }
};
