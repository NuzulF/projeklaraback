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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('aktif')->after('destinasi_id')->default(true);
        });
        Schema::table('destinasi', function (Blueprint $table) {
            $table->boolean('aktif')->after('approve')->default(true);
        });
        Schema::table('kategori', function (Blueprint $table) {
            $table->boolean('aktif')->after('deskripsi')->default(true);
        });
        Schema::table('paket', function (Blueprint $table) {
            $table->boolean('aktif')->after('harga_paket')->default(true);
        });
        Schema::table('wahana', function (Blueprint $table) {
            $table->boolean('aktif')->after('destinasi_id')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('aktif');
        });
        Schema::table('destinasi', function (Blueprint $table) {
            $table->dropColumn('aktif');
        });
        Schema::table('kategori', function (Blueprint $table) {
            $table->dropColumn('aktif');
        });
        Schema::table('paket', function (Blueprint $table) {
            $table->dropColumn('aktif');
        });
        Schema::table('wahana', function (Blueprint $table) {
            $table->dropColumn('aktif');
        });
    }
};
