<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('image_id')->nullable();
			$table->string('title');
			$table->string('slug')->unique();
			$table->mediumText('markdown');
			$table->mediumText('html');
			$table->boolean('featured')->default(0);
			$table->boolean('status')->default(0);
			$table->string('meta_title')->nullable();
			$table->string('meta_description')->nullable();
			$table->integer('published_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->integer('created_by');
			$table->integer('updated_by')->nullable();
			$table->timestamp('published_at')->nullable();
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
		Schema::drop('posts');
	}

}
