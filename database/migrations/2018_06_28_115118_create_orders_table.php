<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            ["user_id",'phone_number','item_name','item_category','bread_type','prize','address'];
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('phone_number');
            $table->string('item_name');
            $table->string('item_category');
            $table->string('bread_type');
            $table->string('address');
            $table->softDeletes();
            $table->timestamps();
//            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
