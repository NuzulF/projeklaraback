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
        Schema::create('profil_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa');
            $table->string('foto_desa')->nullable();
            $table->text('deskripsi_desa')->nullable();
            $table->string('alamat_desa')->nullable();
            $table->unsignedBigInteger('admin_id');
            $table->char('province_id', 2);
            $table->char('regency_id', 4);
            $table->char('district_id', 7);
            $table->string('village_id');
            $table->timestamps();

            $table->foreign('province_id')
            ->references('id')
            ->on('provinces')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('regency_id')
            ->references('id')
            ->on('regencies')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('district_id')
            ->references('id')
            ->on('districts')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('village_id')
            ->references('id')
            ->on('villages')
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
        Schema::dropIfExists('profil_desa');
    }
};
