<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyOrderingr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_toppings', function (Blueprint $table) {
            //
            $table->integer("order_id")->unsigned();
            $table->string("name");
            $table->string("topping_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_toppings', function (Blueprint $table) {
            //
        });
    }
}
