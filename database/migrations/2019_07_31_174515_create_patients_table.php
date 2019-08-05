<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('gender', 2);
            $table->string('birthday_date');
            $table->string('phone_number', 30);
            $table->string('cell_number', 30);
            $table->string('observation')->nullable();
            $table->string('plan');
            $table->string('plan_card_number');
            $table->string('plan_card_valid');
            $table->string('address_cep');
            $table->string('address_street');
            $table->integer('address_number');
            $table->string('address_complement')->nullable();
            $table->integer('country_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->string('phonetic_name')->nullable();
            $table->string('job')->nullable();
            $table->string('cpf');
            $table->string('civil_status');
            $table->string('mother_name')->nullable();
            $table->string('mother_job')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_job')->nullable();
            $table->string('identity');
            $table->string('issuance_date');
            $table->string('issuing_agency');
            $table->string('num_birth_registration')->nullable();
            $table->string('blood_type', 5);
            $table->string('cns', 100)->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('city_id')->references('id')->on('cities');
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
        Schema::dropIfExists('patients');
    }
}
