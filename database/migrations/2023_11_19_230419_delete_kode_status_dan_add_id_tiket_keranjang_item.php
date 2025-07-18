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
        Schema::table('keranjang_item', function (Blueprint $table) {
            $table->dropColumn('kode_tiket');
            $table->dropColumn('status_tiket');
            $table->unsignedBigInteger('tikets_id')->after('index')->nullable();

            $table->foreign('tikets_id')
            ->references('id')
            ->on('tikets')
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
        Schema::table('keranjang_item', function (Blueprint $table) {
            $table->string('kode_tiket')->nullable();
            $table->boolean('status_tiket')->default(false);
        });
    }
};
