@extends('layouts.master')

@section('content')
<div class="container" ng-app="app">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
		<h1>Register.</h1>

		{{ Form::open(array('route' => 'users.store', 'id' => 'register-form', 'name' => 'form', 'autocomplete' => 'off', 'novalidate' => '')) }}

		<div class="form-group">
		    {{ Form::label('email', 'Email Address') }}
		    {{ Form::email('email', NULL, array(
				'class' => 'form-control',
				'placeholder' => 'email@example.com',
				'ng-model' => 'formData.email',
				'required' => true
			))}}
		</div>

        <div class="form-group">
            {{ Form::label('password', 'Password') }}<br>
            {{ Form::password('password', array(
                'class' => 'form-control',
                'ng-model' => 'formData.password',
                'required' => true
            ))}}
        </div>

        <div class="form-group">
            {{ Form::label('password_confirmation', 'Password Confirmation') }}<br>
            {{ Form::password('password_confirmation', array(
                'class' => 'form-control',
                'ng-model' => 'formData.passwordConfirm',
                'data-match' => 'formData.password',
                'required' => true
            ))}}
        </div>

		<div class="form-group">
			<button type="submit" class="btn btn-block" ng-disabled="form.$invalid">Register</button>
		</div>
		{{ Form::close() }}


		</div>
	</div>
</div>
@stop