<?php

class PostsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /posts
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('posts.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /posts/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /posts
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = array(
			'title' => Input::get('title'),
			'markdown' => Input::get('markdown'),
			'status' => Input::get('status')
		);

		$post = new Post();
		$post->user_id = Auth::user()->id;
		$post->created_by = Auth::user()->id;
		$post->title = $input['title'];
		$post->markdown = $input['markdown'];
		$post->slug = getSlug($input['title'], 'Post');
		if($input['status']) {
			$post->published_at = time();
			$post->published_by = Auth::user()->id;
			$message = $input['title'] . ' published.';
		} else {
			$message = $input['title'] . ' saved.';
		}
		$post->status = $input['status'] ? 1 : 0;
		$post->save();

		return Redirect::to('/')->with('success', $message);
	}

	/**
	 * Display the specified resource.
	 * GET /posts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('posts.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /posts/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('posts.edit');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /posts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /posts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}