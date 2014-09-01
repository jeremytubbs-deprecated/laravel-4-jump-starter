@extends('layouts.master')

@section('content')
<div class="container">
	<h1>Add Group</h1>
	{{ Form::open(array('action' => array('RolesController@store'), 'method' => 'POST', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::label('Name') }}
			{{ Form::text('name', NULL, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('Description') }}
			{{ Form::textarea('description', NULL, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
</div>
@stop