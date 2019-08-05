<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	$User = new User();
	$User->email = "admin@gmail.com";
	$User->password = bcrypt("123");
	$User->name = "Admin";
	$User->type = User::ADMIN;
	$User->save();
    }
}
