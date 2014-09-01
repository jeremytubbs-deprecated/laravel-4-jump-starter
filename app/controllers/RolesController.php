<?php

class RolesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /roles
	 *
	 * @return Response
	 */
	public function index()
	{
		$roles = Role::all();
		return View::make('roles.index')->with('roles', $roles);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /roles/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('roles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /roles
	 *
	 * @return Response
	 */
	public function store()
	{
		$role = new Role();
		$role->name = Input::get('name');
		$role->description = Input::get('description');
		$role->save();

		return Redirect::route('admin.groups.index')->with('flash_message', $role->name . ' has been created.');
	}

	/**
	 * Display the specified resource.
	 * GET /roles/{id}
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
	 * GET /roles/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$role = Role::where('id', '=', $id)->first();
		return View::make('roles.edit')->with('role', $role);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /roles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$role = Role::find($id);
		$role->name = Input::get('name');
		$role->description = Input::get('description');
		$role->save();

		return Redirect::route('admin.groups.index')->with('flash_message', $role->name . ' has been updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /roles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$role = Role::find($id);
		$role->delete();
		return Redirect::route('admin.groups.index')->with('flash_message', 'Group has been deleted.');
	}

}