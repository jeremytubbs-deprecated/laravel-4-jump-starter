@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1>Edit Group</h1>
		</div>
		<div class="col-md-6">
			{{ Form::open(array('method' => 'DELETE', 'route' => array('admin.groups.destroy', $role->id))) }}
				<button class="btn btn-default btn-xs pull-right" type="submit">Delete Group</button>
			{{ Form::close() }}
		</div>
	</div>
	{{ Form::model($role, array('action' => array('RolesController@update', $role->id), 'method' => 'PUT', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::label('Name') }}
			{{ Form::text('name', NULL, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('Description') }}
			{{ Form::textarea('description', NULL, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::submit('Update', array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
</div>
@stop