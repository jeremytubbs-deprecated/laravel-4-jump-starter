@extends('layouts.master')

@section('bodyTag')
<body ng-app="myApp">
@stop

@section('content')
{{ Form::open(array('action' => array('PostsController@store'), 'method' => 'POST', 'role' => 'form')) }}
<div class="container-fluid" ng-controller="EditorController">
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
			<textarea class="form-control" name="commonmark" ng-model="editor.text" ui-codemirror ui-codemirror-opts="editorOptions"></textarea>
		</div>
		<div class="col-md-6 preview">
			<div class="editor-output" ng-bind-html="editor.text | commonmark"></div>
		</div>
	</div>
</div>
@stop

@section('footer-content')
<footer class="footer">
	<div class="container-fluid">
		<div class="row" ng-controller="FooterController" ng-init="init('Save Draft', false)">
			<div class="col-md-12">
				<div class="btn-group pull-right dropup">
					<button type="submit" class="btn btn-danger" ng-show="submitStatus"><span ng-bind="submitText"></span></button>
					<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" ng-show="submitStatus">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<button type="submit" class="btn btn-info" ng-hide="submitStatus"><span ng-bind="submitText"></span></button>
					<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" ng-hide="submitStatus">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#" ng-click="updateSubmit('Publish'); submitStatus = !submitStatus">Publish</a></li>
						<li><a href="#" ng-click="updateSubmit('Save Draft'); submitStatus = !submitStatus">Save Draft</a></li>
					</ul>
				</div>
				<input type="hidden" name="status" id="status" value="@{{ submitStatus }}"/>
			</div>
		</div>
	</div>
</footer>
{{ Form::close() }}
@stop

@section('styles')
{{ HTML::style("vendor/codemirror/lib/codemirror.css") }}
@stop

@section('ngscripts')
{{ HTML::script('vendor/codemirror/lib/codemirror.js') }}
{{ HTML::script('vendor/ui-codemirror.min.js') }}
{{ HTML::script('vendor/commonmark.js') }}
<script src="http://cdnjs.cloudflare.com/ajax/libs/showdown/0.3.1/showdown.min.js"></script>
@stop