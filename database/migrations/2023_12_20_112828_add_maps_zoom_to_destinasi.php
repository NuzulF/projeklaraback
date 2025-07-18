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
        Schema::table('destinasi', function (Blueprint $table) {
            $table->integer('maps_zoom')->default(14)->after('maps_destinasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('destinasi', function (Blueprint $table) {
            $table->dropColumn('maps_zoom');
        });
    }
};
