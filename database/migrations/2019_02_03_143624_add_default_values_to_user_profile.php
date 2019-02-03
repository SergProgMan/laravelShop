<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultValuesToUserProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function(Blueprint $table){
            $table->string('full_name')->default('')->change();
            $table->string('street')->default('')->change();
            $table->string('city')->default('')->change();
            $table->string('phone')->default('')->change();
            $table->text('bio')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('full_name')->change();
            $table->string('street')->change();
            $table->string('city')->change();
            $table->string('phone')->change();
            $table->text('bio')->change();
        });
    }
}
