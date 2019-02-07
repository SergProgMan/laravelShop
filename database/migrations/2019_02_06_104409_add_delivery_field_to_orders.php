<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeliveryFieldToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function(Blueprint $table){
            $table->dropColumn('street');
            $table->dropColumn('city');

            $table->string('np_city')->default('');
            $table->string('np_warehouse')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function(Blueprint $table){
            $table->string('street')->default('');
            $table->string('street')->default('');

            $table->dropColumn('np_city');
            $table->dropColumn('np_warehouse');
        });
    }
}
