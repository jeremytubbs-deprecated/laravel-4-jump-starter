<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use SammyK\LaravelFacebookSdk\FacebookableTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait, FacebookableTrait;

    protected $dates = ['deleted_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token', 'access_token');

	protected static $facebook_field_aliases = [
        'facebook_field_name' => 'database_column_name',
        'id' => 'facebook_user_id',
    ];

	public function roles() {
		return $this->belongsToMany('Role');
	}

	public function hasRole($name) {
		foreach ($this->roles as $role) {
			if ($role->name == $name) return true;
		}
		return false;
	}

	public function assignRole($role) {
		return $this->roles()->attach($role);
	}

	public function removeRole($role) {
		return $this->roles()->detach($role);
	}

	public function getFullnameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

}
