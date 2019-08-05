<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UserSeed::class);
        $this->call(CountrySeed::class);
        $this->call(StatesSeed::class);
        $this->call(CitiesSeed::class);
        $this->call(ProfessionalAdvicesSeed::class);
    }
}
