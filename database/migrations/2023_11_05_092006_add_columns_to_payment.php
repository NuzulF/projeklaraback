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
        Schema::table('jenis_pembayaran', function (Blueprint $table) {
            $table->boolean('enabled_payment')->after('kode')->default(true);
            $table->boolean('identifikasi_transaksi')->after('enabled_payment')->default(false);
            $table->unsignedBigInteger('id_parent_jenis_pembayaran')->after('identifikasi_transaksi')->nullable()->default(null);

            $table->foreign('id_parent_jenis_pembayaran')
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
        Schema::table('jenis_pembayaran', function (Blueprint $table) {
            $table->dropColumn('enabled_payment');
            $table->dropColumn('identifikasi_transaksi');
            $table->dropColumn('id_parent_jenis_pembayaran');
        });
    }
};
