@extends('layouts.master')

@section('content')
<form role="form">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<input class="form-control" type="text" name="title" />
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<textarea class="form-control editor-input" ng-model="editor.text" ui-codemirror></textarea>
		</div>
		<div class="col-md-6 editor-output" ng-bind-html="editor.text | markdown"></div>
	</div>
</div>
</form>
@stop

@section('styles')
{{ HTML::style("vendor/codemirror/lib/codemirror.css") }}
@stop

@section('scripts')
{{ HTML::script('vendor/codemirror/lib/codemirror.js') }}
{{ HTML::script('vendor/ui-codemirror.min.js') }}
<script src="http://cdnjs.cloudflare.com/ajax/libs/showdown/0.3.1/showdown.min.js"></script>
@stop