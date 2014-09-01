@extends('layouts.master')

@section('content')
<div class="container">
	<h1>Dashboard</h1>
	<ul>
		<li>{{ link_to_route('admin.users.index', 'Site Users')}}</li>
		<li>{{ link_to_route('admin.groups.index', 'Manage Groups')}}</li>
	</ul>
</div>
@stop