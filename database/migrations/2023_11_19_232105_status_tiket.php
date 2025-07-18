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
        Schema::create('status_tiket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tikets_id');
            $table->unsignedBigInteger('wahana_id');
            $table->boolean('status_tiket')->default(false);
            $table->timestamps();

            $table->foreign('tikets_id')
            ->references('id')
            ->on('tikets')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('wahana_id')
            ->references('id')
            ->on('wahana')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_tiket');
    }
};
