<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		//create admin user
		$user = User::create(array(
			'password' => Hash::make('admin'),
	        'email'	   => 'admin@admin.com',
	        'active' => 1
	    ));
	    $user->save();
	    //create admin role
	    $role = Role::create(array(
	    	'name' => 'admin'
	    ));
	    //assign admin role to first user
	    $user = User::find(1);
	    $user->assignRole(1);

	    //Create non admin user
	    $user = User::create(array(
			'password' => Hash::make('user'),
	        'email'	   => 'user@user.com',
	        'active' => 1
	    ));
	    $user->save();
	}
}
