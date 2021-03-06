<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                Schema::dropIfExists('products');
                $table->bigIncrements('id');
                $table->string("product_name");
                $table->string("product_description");
                $table->string("product_price");
                $table->string("merchant_name");
                $table->string("merchant_number");
                $table->string("product_category");
                $table->string("slug");
                $table->timestamps();
            });
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
