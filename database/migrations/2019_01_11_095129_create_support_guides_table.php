<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_guides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text')->nullable();
            $table->unsignedInteger('media_id')->nullable();
            $table->integer('order_id');
            $table->timestamps();
        });

        Schema::table('support_guides', function (Blueprint $table) {
            $table->foreign('media_id')->references('id')->on('media')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support_guides');
    }
}
