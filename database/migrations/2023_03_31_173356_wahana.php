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
        Schema::create('wahana', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wahana');
            $table->string('foto_wahana');
            $table->integer('htm_wahana');
            $table->text('deskripsi_wahana');
            $table->unsignedBigInteger('destinasi_id');
            $table->timestamps();

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
        Schema::dropIfExists('wahana');
    }
};
