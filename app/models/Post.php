<?php

class Post extends \Eloquent {

	protected $fillable = [];
	protected $dates = ['deleted_at', 'published_at'];

}