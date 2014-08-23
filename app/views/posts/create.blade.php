@extends('layouts.master')

@section('content')
<div class="container">
	<textarea class="form-control" ng-model="editor.text"></textarea>
	<div ng-bind-html="editor.text | markdown"></div>
</div>
@stop

@section('styles')
<script src="http://cdnjs.cloudflare.com/ajax/libs/showdown/0.3.1/showdown.min.js"></script>
@stop