@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1>Edit User</h1>
		</div>
		<div class="col-md-6">
			{{ Form::open(array('method' => 'DELETE', 'route' => array('admin.users.destroy', $user->id))) }}
	    		<button class="btn btn-default btn-xs pull-right" type="submit">Delete User</button>
			{{ Form::close() }}
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
		{{ Form::model($user, array('action' => array('UsersController@update', $user->id), 'method' => 'PUT', 'role' => 'form')) }}
			<div class="form-group">
				{{ Form::label('First Name') }}
				{{ Form::text('first_name', NULL, array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('Last Name') }}
				{{ Form::text('last_name', NULL, array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('Email') }}
				{{ Form::text('email', NULL, array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
			</div>
		{{ Form::close() }}
		</div>
		@if (! Auth::guest() && Auth::user()->hasRole('admin'))
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Groups</div>
				<table class="table">
					<tbody>
						@foreach($roles as $role)
						<tr>
							<td>{{ $role->name }}</td>
								@if(in_array($role->name, $user_roles))
								<td>
									{{ Form::open(array('method' => 'POST', 'action' => array('UsersController@removeRole', $user->id, $role->id))) }}
	    								<button class="btn btn-default btn-xs pull-right" type="submit">Remove</button>
									{{ Form::close() }}
								</td>
								@else
								<td>
									{{ Form::open(array('method' => 'POST', 'action' => array('UsersController@assignRole', $user->id, $role->id))) }}
	    								<button class="btn btn-default btn-xs pull-right" type="submit">Add</button>
									{{ Form::close() }}
								</td>
								@endif
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@endif
	</div>
</div>
@stop