<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            
   
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('user')->onUpdate('cascade');
            $table->enum('status', array('0','1','2'))->default('0');
           $table->bigInteger('total');
           $table->date('date')->nullable();
           $table->string('name')->nullable();
           $table->string('phone')->nullable();
           $table->string('address')->nullable();
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
        Schema::dropIfExists('order');
    }
}
