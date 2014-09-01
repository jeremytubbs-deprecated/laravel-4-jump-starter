@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<h1>Contact.</h1>
		</div>
	</div>
		
	{{ Form::open(array('route' => 'contact.send', 'id' => 'contact-form')) }}
	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<div class="form-group">
				<input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ Input::old('name') }}" required>
			</div>
			<div class="form-group">
				<input type="email" name="email" class="form-control" placeholder="email@example.com" value="{{ Input::old('email') }}" required>
			</div>
			<div class="form-group">
				<textarea class="form-control" name="message" rows="4" placeholder="Your Message..." required>{{ Input::old('message') }}</textarea>
			</div>
	
			<label class="control-label" for="onoffswitch">HUMAN?</label>
	
			<div class="onoffswitch">
				<input type="checkbox" name="human" class="onoffswitch-checkbox" id="myonoffswitch">
				<label class="onoffswitch-label" for="myonoffswitch">
					<div class="onoffswitch-inner"></div>
					<div class="onoffswitch-switch"></div>
				</label>
			</div>
	
			<button class="btn btn-default pull-right" type="submit">Send Message</button>
		</div>
	</div>
	{{ Form::close() }}
</div>
@stop