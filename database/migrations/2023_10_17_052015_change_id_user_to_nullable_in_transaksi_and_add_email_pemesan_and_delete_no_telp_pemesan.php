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
        Schema::table('transaksi', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->string('email_pemesan')->after('nama_pemesan');
            $table->dropColumn('no_telp_pemesan');
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
            $table->string('no_telp_pemesan')->after('nama_pemesan');
            $table->dropColumn('email_pemesan');
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }
};
