<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('home_elantype')->nullable();
            $table->integer('home_type')->nullable();
            $table->integer('home_rooms')->nullable();
            $table->integer('home_city')->nullable();
            $table->integer('home_street')->nullable();
            $table->integer('home_sahe')->nullable();
            $table->integer('home_floor')->nullable();
            $table->integer('home_firstfloor')->nullable();
            $table->integer('home_lastfloor')->nullable();
            $table->integer('home_metro')->nullable();
            $table->integer('home_cixaris')->nullable();
            $table->integer('home_esyali')->nullable();
            $table->integer('home_temirli')->nullable();
            $table->integer('home_su')->nullable();
            $table->integer('home_lift')->nullable();
            $table->integer('home_pvc')->nullable();
            $table->integer('home_kombi')->nullable();
            $table->integer('home_qaz')->nullable();
            $table->integer('home_isiq')->nullable();
            $table->integer('home_kabeltv')->nullable();
            $table->integer('home_balkon')->nullable();
            $table->integer('home_safedoor')->nullable();
            $table->integer('home_kondisioner')->nullable();
            $table->integer('home_metbexmebel')->nullable();
            $table->integer('home_telefon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
