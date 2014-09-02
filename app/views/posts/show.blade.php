@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div data-markdown>
{{ $post->markdown }}
	</div>
</div>
@stop

@section('styles')
{{ HTML::style("vendor/codemirror/lib/codemirror.css") }}
@stop

@section('scripts')
{{ HTML::script('vendor/codemirror/lib/codemirror.js') }}
{{ HTML::script('vendor/ui-codemirror.min.js') }}
<script src="http://cdnjs.cloudflare.com/ajax/libs/showdown/0.3.1/showdown.min.js"></script>
@stop