<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_item_product', function (Blueprint $table) {
            $table->unsignedBigInteger('cart_item_id')->index();
           $table->foreign('cart_item_id')->references('id')->on('cart_item')->onUpdate('cascade');
           $table->unsignedBigInteger('product_id')->index();
           $table->foreign('product_id')->references('id')->on('product')->onUpdate('cascade');
           $table->primary(['cart_item_id', 'product_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_item_product');
    }
}
