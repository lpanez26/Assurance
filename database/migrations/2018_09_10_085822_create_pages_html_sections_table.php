<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesHtmlSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_html_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_id')->nullable();
            $table->text('html')->nullable();
            $table->text('css')->nullable();
            $table->tinyInteger('desktop_visible');
            $table->tinyInteger('mobile_visible');
            $table->integer('order_id');
            $table->timestamps();
        });

        Schema::table('pages_html_sections', function (Blueprint $table) {
            $table->foreign('page_id')->references('id')->on('pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages_html_sections');
    }
}
