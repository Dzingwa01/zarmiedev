<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    {
        Schema::table('order_histories', function (Blueprint $table) {
            //
            $table->decimal('total_cost')->nullable();
            $table->string('special_instructions')->nullable();
            $table->string('delivery_or_collect')->nullable();
            $table->string('delivery_collect_time')->nullable();
            $table->string('address')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_histories', function (Blueprint $table) {
            //
        });
    }
}
