<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		$user = User::create(array(
			'password' => Hash::make('admin'),
	        'email'	   => 'admin@admin.com',
	        'active' => 1
	    ));

	    $user->save();

	    $role = Role::create(array(
	    	'name' => 'admin'
	    ));

	    $user = User::find(1);
	    $user->assignRole(1);
	}

}
