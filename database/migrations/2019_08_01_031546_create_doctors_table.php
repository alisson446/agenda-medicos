<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('gender', 2);
            $table->string('birthday_date');
            $table->string('phone_number', 30);
            $table->string('cell_number', 30);
            $table->string('address_cep');
            $table->string('address_street');
            $table->integer('address_number');
            $table->string('address_complement')->nullable();
            $table->integer('country_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->tinyInteger('allows_docking');
            $table->string('cpf');
            $table->string('identity');
            $table->string('issuance_date');
            $table->string('issuing_agency');
            $table->integer('professional_advice_id')->unsigned();
            $table->integer('professional_advice_state_id')->unsigned();
            $table->string('professional_advice_number');
            $table->string('professional_advice_type');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('professional_advice_id')->references('id')->on('professional_advices');
            $table->foreign('professional_advice_state_id')->references('id')->on('states');
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
        Schema::dropIfExists('doctors');
    }
}
