<!DOCTYPE html>
<html lang="en" ng-app="myApp">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		@section('meta')
            <title>Laravel Starter</title>
            <meta name="description" content="Laravel Starter">
		@show
        {{ HTML::style('vendor/bootstrap.min.css') }}
        {{ HTML::style('styles/main.min.css') }}
		@yield('styles')
    </head>
    <body>
        @section('header')
    	   @include('layouts.partials._header')
        @show

        <div class="container">
        @yield('breadcrumb')
		@include('layouts.partials._notifications')
        </div>


        @yield('content')

        @section('footer')
           @include('layouts.partials._footer')
        @show

        {{-- scripts --}}
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script> -->
        {{ HTML::script('vendor/bootstrap.min.js') }}
        {{ HTML::script('vendor/angular/angular.min.js') }}
        {{ HTML::script('app/app.js') }}
        @yield('scripts')
    </body>
</html>