<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveNotnullableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function($table)
        {
            $table->string('name')->nullable()->change();
            $table->string('birthday_date')->nullable()->change();
        });

        Schema::table('doctors', function($table)
        {
            $table->string('name', 255)->nullable()->change();
            $table->string('email', 255)->nullable()->change();
            $table->string('gender', 2)->nullable()->change();
            $table->string('birthday_date')->nullable()->change();
            $table->string('phone_number', 30)->nullable()->change();
            $table->string('cell_number', 30)->nullable()->change();
            $table->string('address_cep')->nullable()->change();
            $table->string('address_street')->nullable()->change();
            $table->integer('address_number')->nullable()->change();
            $table->integer('country_id')->unsigned()->nullable()->change();
            $table->integer('state_id')->unsigned()->nullable()->change();
            $table->integer('city_id')->unsigned()->nullable()->change();
            $table->smallInteger('allows_docking')->nullable()->change();
            $table->string('cpf')->nullable()->change();
            $table->string('identity')->nullable()->change();
            $table->string('issuance_date')->nullable()->change();
            $table->string('issuing_agency')->nullable()->change();
            $table->integer('professional_advice_id')->unsigned()->nullable()->change();
            $table->integer('professional_advice_state_id')->unsigned()->nullable()->change();
            $table->string('professional_advice_number')->nullable()->change();
            $table->string('professional_advice_type')->nullable()->change();
        });

        Schema::table('schedules', function($table)
        {
            $table->integer('specialty_id')->unsigned()->nullable()->change();
            $table->integer('doctor_id')->unsigned()->nullable()->change();
            $table->integer('patient_id')->unsigned()->nullable()->change();
            $table->string('initial_date')->nullable()->change();
            $table->string('finish_date')->nullable()->change();
            $table->string('initial_hour')->nullable()->change();
            $table->string('finish_hour')->nullable()->change();
            $table->string('plan')->nullable()->change();
            $table->string('value')->nullable()->change();
            $table->string('title')->nullable()->change();
            $table->string('start')->nullable()->change();
            $table->string('end')->nullable()->change();
        });

        Schema::table('notes', function($table)
        {
            $table->integer('doctor_id')->unsigned()->nullable()->change();
            $table->integer('patient_id')->unsigned()->nullable()->change();
            $table->longText('note')->nullable()->change();
            $table->dateTime('reminder')->nullable()->change();
        });

        Schema::table('rooms', function($table)
        {
            $table->string('name')->nullable()->change();
        });

        Schema::table('users', function($table)
        {
            $table->string('name')->nullable()->change();
            $table->string('type')->nullable()->change();
            $table->string('password')->nullable()->change();
        });

        Schema::table('specialties', function($table)
        {
            $table->string('name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
