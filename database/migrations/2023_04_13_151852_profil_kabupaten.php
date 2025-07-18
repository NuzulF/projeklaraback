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
        Schema::create('profil_kabupaten', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kabupaten');
            $table->string('foto_kabupaten')->nullable();
            $table->unsignedBigInteger('admin_id');
            $table->char('province_id', 2);
            $table->string('regency_id');
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profil_kabupaten');
    }
};
