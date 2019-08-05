<?php

use Illuminate\Database\Seeder;

class ProfessionalAdvicesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('professional_advices')->delete();

        DB::table('professional_advices')->insert(['id' => 1, 'name' => 'CRM'], ['id' => 2, 'name' => 'Coren']);
    }
}
