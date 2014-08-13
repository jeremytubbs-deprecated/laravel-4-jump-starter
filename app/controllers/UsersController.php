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