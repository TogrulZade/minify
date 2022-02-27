<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhoneProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('phone_marka')->nullable();
            $table->integer('phone_model')->nullable();
            $table->integer('phone_color')->nullable();
            $table->integer('phone_yaddas')->nullable();
            $table->integer('phone_ram')->nullable();
            $table->integer('phone_simkart')->nullable();
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
