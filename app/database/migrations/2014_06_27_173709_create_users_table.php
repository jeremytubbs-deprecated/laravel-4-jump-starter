<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->string('slug')->unique()->nullable();
			$table->string('email', 100)->unique();
			$table->string('password', 60);
			$table->string('confirmation_hash', 60)->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->bigInteger('facebook_user_id')->unsigned()->index();
			$table->string('access_token')->nullable();
			$table->boolean('active')->default(0);
			$table->boolean('suspended')->default(0);
			$table->softDeletes();
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
		Schema::drop('users');
	}

}
