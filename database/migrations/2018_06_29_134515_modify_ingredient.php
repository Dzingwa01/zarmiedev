<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyIngredient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingredient', function (Blueprint $table) {
            //
//            $table->dropColumn('updated_at');
            $table->decimal('medium_prize')->nullable();
            $table->decimal('large_prize')->nullable();
            $table->decimal('wrap_prize')->nullable();
//            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingredient', function (Blueprint $table) {
            //
            $table->dropColumn('medium_prize');
            $table->dropColumn('large_prize');
            $table->dropColumn('wrap_prize');
        });
    }
}
