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
            $table->string('kode')->after('nama');
            $table->boolean('status')->after('kode')->default(true);
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
            $table->dropColumn('status');
            $table->dropColumn('kode');
        });
    }
};
