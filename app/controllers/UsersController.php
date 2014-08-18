<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::with('roles')->get();
		return View::make('users.index', array(
			'users' => $users
		));
	}

	/**
	 * Display form for new registrations
	 * GET /users
	 *
	 * @return Response
	 */
	public function register()
	{
		return View::make('users.register');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles = Role::lists('name', 'id');
		return View::make('users.create')->withRoles($roles);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = array(
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation')
            );
		$rules = array(
			'password' => 'required|confirmed|min:6',
	        'email' => 'required|email|unique:users'
		);
		$validator = Validator::make($input, $rules);

		if ($validator->passes()) {
			$user = new User;
			$user->email = $input['email'];
			$user->password = Hash::make($input['password']);
			$user->active = 1;
			$user->save();
			// $this->mailer->welcome($user);

			Auth::login($user);

    		return Redirect::to('/')->with('flash_message', 'You are now registered.');
		}
		$error = $validator->messages();
		return Redirect::back()->with('error', $error);
	}

	public function create_facebook()
	{
		return Redirect::to(Facebook::getLoginUrl());
	}

	public function store_facebook()
	{
		try {
			$token = Facebook::getTokenFromRedirect();
			if ( ! $token) return Redirect::to('/')->with('error', 'Unable to obtain access token.');
		} catch (FacebookQueryBuilderException $e) {
			return Redirect::to('/')->with('error', $e->getPrevious()->getMessage());
		}

		if ( ! $token->isLongLived()) {
			/**
			 * Extend the access token.
			 */
			try {
				$token = $token->extend();
			} catch (FacebookQueryBuilderException $e) {
				return Redirect::to('/')->with('error', $e->getPrevious()->getMessage());
			}
		}

		Facebook::setAccessToken($token);

		/**
		 * Get basic info on the user from Facebook.
		 */
		try {
			$facebook_user = Facebook::object('me')->fields('id','first_name', 'last_name', 'email')->get();
		} catch (FacebookQueryBuilderException $e) {
			return Redirect::to('/')->with('error', $e->getPrevious()->getMessage());
		}

		// Create the user if not exists or update existing
		$user = User::createOrUpdateFacebookObject($facebook_user);
		$user->access_token = $token->access_token;
		$user->active = 1;
		$user->save();

		// Log the user into Laravel
		Facebook::auth()->login($user);

		return Redirect::to('/')->with('message', 'Successfully logged in with Facebook');
	}

	/**
	 * Admin Add User - user will not have password
	 * POST admin/users/create
	 *
	 * @return Response
	 */
	public function add()
	{
		$input = array(
            'email' => Input::get('email'),
            );
		$rules = array(
	        'email' => 'required|email|unique:users'
		);
		$validator = Validator::make($input, $rules);

		if ($validator->passes()) {
			$user = new User;
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email = $input['email'];
			$user->active = 1;
			$user->save();
			// $this->mailer->welcome($user);

			if (Input::get('group_id') != '0') {
				$user->assignRole(Input::get('group_id'));
			}

    		return Redirect::route('admin.users.index')->with('success', $user->email . ' has been created.');
		}
		$error = $validator->messages();
		return Redirect::back()->with('error', $error);
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::with('roles')->where('id', '=', $id)->first();
		$user_roles = array();
		foreach ($user->roles as $role) {
			$user_roles[$role->id] = $role->name;
		}
		$roles = Role::select('name', 'id')->get();
		return View::make('users.edit', array(
			'user' => $user,
			'user_roles' => $user_roles,
			'roles' => $roles
		));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->save();

		return Redirect::route('admin.users.index')->with('flash_message', $user->first_name . ' ' . $user->last_name . ' has been updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();
		return Redirect::route('admin.users.index')->with('flash_message', 'User has been deleted.');
	}

	public function assignRole($id, $role)
	{
		$user = User::find($id);
	    $user->assignRole($role);
	    return Redirect::back();
	}

	public function removeRole($id, $role)
	{
		$user = User::find($id);
	    $user->removeRole($role);
	    return Redirect::back();
	}

}