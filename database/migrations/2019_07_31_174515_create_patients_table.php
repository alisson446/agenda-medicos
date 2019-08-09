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
            $table->string('email', 255)->nullable();
            $table->string('gender', 2)->nullable();
            $table->string('birthday_date');
            $table->string('phone_number', 30)->nullable();
            $table->string('cell_number', 30)->nullable();
            $table->string('observation')->nullable();
            $table->string('plan')->nullable();
            $table->string('plan_card_number')->nullable();
            $table->string('plan_card_valid')->nullable();
            $table->string('address_cep')->nullable();
            $table->string('address_street')->nullable();
            $table->integer('address_number')->nullable();
            $table->string('address_complement')->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('state_id')->unsigned()->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->string('phonetic_name')->nullable();
            $table->string('job')->nullable();
            $table->string('cpf')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('mother_name')->nullable()->nullable();
            $table->string('mother_job')->nullable()->nullable();
            $table->string('father_name')->nullable()->nullable();
            $table->string('father_job')->nullable()->nullable();
            $table->string('identity')->nullable();
            $table->string('issuance_date')->nullable();
            $table->string('issuing_agency')->nullable();
            $table->string('num_birth_registration')->nullable();
            $table->string('blood_type', 5)->nullable();
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
