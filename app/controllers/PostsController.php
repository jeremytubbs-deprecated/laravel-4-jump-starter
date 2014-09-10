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
		$posts = Post::all();
		return View::make('posts.index')->with('posts', $posts);
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
		if($input['status'] == 'true') {
			$post->published_at = time();
			$post->published_by = Auth::user()->id;
			$message = $input['title'] . ' published.';
		} else {
			$message = $input['title'] . ' saved.';
		}
		$post->status = $input['status'] == 'true' ? 1 : 0;
		$post->save();

		return Redirect::to('admin/posts')->with('success', $message);
	}

	/**
	 * Display the specified resource.
	 * GET /posts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$post = Post::where('slug', '=', $slug)->first();
		return View::make('posts.show', compact('post'));
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
		$post = Post::find($id);
		return View::make('posts.edit')->with('post', $post);;
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
		$input = array(
			'title' => Input::get('title'),
			'markdown' => Input::get('markdown'),
			'status' => Input::get('status')
		);

		$post = Post::find($id);
		$post->user_id = Auth::user()->id;
		$post->created_by = Auth::user()->id;
		$post->title = $input['title'];
		$post->markdown = $input['markdown'];
		$post->slug = getSlug($input['title'], 'Post');
		if($input['status'] == 'true') {
			$post->published_at = time();
			$post->published_by = Auth::user()->id;
			$message = $input['title'] . ' published post updated.';
		} else {
			$message = $input['title'] . 'unpublished updates saved.';
		}
		$post->status = $input['status'] == 'true' ? 1 : 0;
		$post->save();

		return Redirect::to('admin/posts')->with('success', $message);
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