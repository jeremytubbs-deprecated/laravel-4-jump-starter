@extends('layouts.master')

@section('content')
<div class="container">
	<h1>Dashboard</h1>
	{{ link_to_route('admin.users.index', 'Site Users')}}
</div>
@stop