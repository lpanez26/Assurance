<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculatorParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculator_parameters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country');
            $table->string('code');
            $table->string('slug');
            $table->string('phone_code')->nullable();
            $table->integer('param_gd_cd_id');
            $table->integer('param_gd_cd');
            $table->integer('param_gd_id');
            $table->integer('param_cd_id');
            $table->integer('param_gd');
            $table->integer('param_cd');
            $table->integer('param_id');
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
        Schema::dropIfExists('calculator_parameters');
    }
}
