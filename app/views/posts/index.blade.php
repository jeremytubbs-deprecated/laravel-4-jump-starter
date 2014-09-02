@extends('layouts.master')

@section('content')
<div class="container-fluid">
	@foreach($posts as $post) 
		{{ link_to_action('PostsController@show', $post->title, $parameters = array($post->slug)) }}<br>
	@endforeach
</div>
@stop