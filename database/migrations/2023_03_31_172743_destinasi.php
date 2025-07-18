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
        Schema::create('destinasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_destinasi');
            $table->unsignedBigInteger('kategori_id');
            $table->string('foto_destinasi')->nullable();
            $table->string('logo');
            $table->char('province_id', 2)->nullable();
            $table->char('regency_id', 4)->nullable();
            $table->char('district_id', 7)->nullable();
            $table->char('village_id', 10)->nullable();
            $table->text('deskripsi_destinasi');
            $table->text('maps_destinasi');
            $table->string('alamat_destinasi');
            $table->integer('htm_destinasi');
            $table->enum('approve', [0, 1]);
            $table->timestamps();

            $table->foreign('kategori_id')
                ->references('id')
                ->on('kategori')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('village_id')
                ->references('id')
                ->on('villages')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('regency_id')
                ->references('id')
                ->on('regencies')
                ->onUpdate('cascade')
                ->onDelete('restrict');
                
            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
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
        Schema::dropIfExists('destinasi');
    }
};
