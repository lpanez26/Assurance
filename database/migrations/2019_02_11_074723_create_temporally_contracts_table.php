<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporallyContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporally_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dentist_id');
            $table->string('patient_fname', 100);
            $table->string('patient_lname', 100);
            $table->string('patient_email', 100);
            $table->string('professional_company_number', 100);
            $table->string('general_dentistry');
            $table->float('monthly_premium');
            $table->tinyInteger('check_ups_per_year');
            $table->tinyInteger('teeth_cleaning_per_year');
            $table->string('slug')->unique();
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
        Schema::dropIfExists('temporally_contracts');
    }
}
