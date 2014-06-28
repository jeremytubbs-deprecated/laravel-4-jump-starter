<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		$user = User::create(array(
			'password' => Hash::make('admin'),
			'first_name' => 'Jeremy',
	        'last_name' => 'Tubbs',
	        'email'	   => 'jtubbs@imamuseum.org',
	        'active' => 1
	    ));

	    $user->save();

	    $role = Role::create(array(
	    	'name' => 'admin'
	    ));
	}

}
