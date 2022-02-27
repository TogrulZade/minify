<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCarDetailsToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('car_marka')->nullable();
            $table->integer('car_model')->nullable();
            $table->integer('car_il')->nullable();
            $table->integer('car_ban')->nullable();
            $table->integer('car_reng')->nullable();
            $table->integer('car_yurus')->nullable();
            $table->integer('car_city')->nullable();
            $table->integer('car_yanacaq')->nullable();
            $table->integer('car_oturucu')->nullable();
            $table->integer('car_suretler')->nullable();
            $table->integer('car_muherrik')->nullable();
            $table->integer('car_kredit')->nullable();
            $table->integer('car_barter')->nullable();
            $table->integer('car_yunguldisk')->nullable();
            $table->integer('car_merkeziqapanma')->nullable();
            $table->integer('car_derisalon')->nullable();
            $table->integer('car_oturacaqventilyasiya')->nullable();
            $table->integer('car_abs')->nullable();
            $table->integer('car_parkradar')->nullable();
            $table->integer('car_ksenon')->nullable();
            $table->integer('car_lyuk')->nullable();
            $table->integer('car_kondisioner')->nullable();
            $table->integer('car_arxakamera')->nullable();
            $table->integer('car_yagissensor')->nullable();
            $table->integer('car_oturacaqisidilme')->nullable();
            $table->integer('car_yanperde')->nullable();
            $table->integer('car_elantype')->nullable();
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
