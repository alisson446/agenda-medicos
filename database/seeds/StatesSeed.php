<?php

use Illuminate\Database\Seeder;

class StatesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->delete();

        DB::table('states')->insert(['id' => 1, 'name' => 'Acre', 'abbreviation' => 'AC', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 2, 'name' => 'Alagoas', 'abbreviation' => 'AL', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 3, 'name' => 'Amapá', 'abbreviation' => 'AP', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 4, 'name' => 'Amazonas', 'abbreviation' => 'AM', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 5, 'name' => 'Bahia', 'abbreviation' => 'BA', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 6, 'name' => 'Ceará', 'abbreviation' => 'CE', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 7, 'name' => 'Distrito Federal', 'abbreviation' => 'DF', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 8, 'name' => 'Espírito Santo', 'abbreviation' => 'ES', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 9, 'name' => 'Goiás', 'abbreviation' => 'GO', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 10, 'name' => 'Maranhão', 'abbreviation' => 'MA', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 11, 'name' => 'Mato Grosso', 'abbreviation' => 'MT', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 12, 'name' => 'Mato Grosso do Sul', 'abbreviation' => 'MS', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 13, 'name' => 'Minas Gerais', 'abbreviation' => 'MG', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 14, 'name' => 'Pará', 'abbreviation' => 'PA', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 15, 'name' => 'Paraíba', 'abbreviation' => 'PB', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 16, 'name' => 'Paraná', 'abbreviation' => 'PR', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 17, 'name' => 'Pernambuco', 'abbreviation' => 'PE', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 18, 'name' => 'Piauí', 'abbreviation' => 'PI', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 19, 'name' => 'Rio de Janeiro', 'abbreviation' => 'RJ', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 20, 'name' => 'Rio Grande do Norte', 'abbreviation' => 'RN', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 21, 'name' => 'Rio Grande do Sul', 'abbreviation' => 'RS', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 22, 'name' => 'Rondônia', 'abbreviation' => 'RO', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 23, 'name' => 'Roraima', 'abbreviation' => 'RR', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 24, 'name' => 'Santa Catarina', 'abbreviation' => 'SC', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 25, 'name' => 'São Paulo', 'abbreviation' => 'SP', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 26, 'name' => 'Sergipe', 'abbreviation' => 'SE', 'country_id' => 1]);
        DB::table('states')->insert(['id' => 27, 'name' => 'Tocantins', 'abbreviation' => 'TO', 'country_id' => 1]);
    }
}
