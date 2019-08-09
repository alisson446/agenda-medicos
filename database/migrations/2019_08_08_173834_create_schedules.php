<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('specialty_id')->unsigned();
            $table->integer('doctor_id')->unsigned();
            $table->integer('patient_id')->unsigned();
            $table->string('initial_date');
            $table->string('finish_date');
            $table->string('initial_hour');
            $table->string('finish_hour');
            $table->string('plan');
            $table->string('value');
            $table->string('title');
            $table->string('start');
            $table->string('end');
            $table->foreign('specialty_id')->references('id')->on('specialties');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('patient_id')->references('id')->on('patients');
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
        Schema::dropIfExists('schedules');
    }
}
