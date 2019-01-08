<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->enum('type', ['page', 'file']);
            $table->string('url')->nullable();
            $table->integer('order_id');
            $table->tinyInteger('new_window');
            $table->tinyInteger('desktop_visible');
            $table->tinyInteger('mobile_visible');
            $table->string('id_attribute')->nullable();
            $table->string('class_attribute')->nullable();
            $table->unsignedInteger('media_id')->nullable();
            $table->unsignedInteger('menu_id')->nullable();
            $table->timestamps();
        });

        Schema::table('menu_elements', function (Blueprint $table) {
            $table->foreign('media_id')->references('id')->on('media')->onDelete('set null');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_elements');
    }
}
