@extends('layouts.master')

@section('content')
{{ Form::open(array('action' => array('PostsController@store'), 'method' => 'POST', 'role' => 'form')) }}
<div class="container-fluid" ng-controller="MyController">
	<div class="row">
		<div class="col-md-12">
			<input class="form-control" type="text" name="title" placeholder="Title"/>
		</div>
	</div>
	<div class="row editor-info">
		<div class="col-md-12">
			<div class="pull-right"><span ng-bind="countOf(editor.text)"></span> Words</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 editor">
			<textarea class="form-control" name="markdown" ng-model="editor.text" ui-codemirror ui-codemirror-opts="editorOptions"></textarea>
		</div>
		<div class="col-md-6 preview">
			<div class="editor-output" ng-bind-html="editor.text | markdown"></div>
		</div>
	</div>
</div>
@stop

@section('footer-content')
	<div class="row">
		<div class="col-md-12">
			<p class="pull-right">{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}</p>
		</div>
	</div>
{{ Form::close() }}
@stop

@section('styles')
{{ HTML::style("vendor/codemirror/lib/codemirror.css") }}
@stop

@section('scripts')
{{ HTML::script('vendor/codemirror/lib/codemirror.js') }}
{{ HTML::script('vendor/ui-codemirror.min.js') }}
<script src="http://cdnjs.cloudflare.com/ajax/libs/showdown/0.3.1/showdown.min.js"></script>
@stop