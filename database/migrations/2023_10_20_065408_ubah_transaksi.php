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
        //old : 'nama_pemesan', 'email_pemesan', 'total_pembayaran', 'user_id', 'jenis_pembayaran_id', 'status','order_id'
        //new :         'nama_pemesan', 'email_pemesan', 'no_telp_pemesan', 'user_id', 'total_pembayaran', 'jenis_pembayaran_id', 'status', 'order_id'
        Schema::table('transaksi', function (Blueprint $table) {
            $table->string('no_telp_pemesan')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn('no_telp_pemesan');
        });
    }
};
