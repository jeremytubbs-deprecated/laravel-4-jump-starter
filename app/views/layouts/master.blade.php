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
        {{ HTML::style('styles/vendor.min.css') }}
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
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        {{ HTML::script('scripts/vendor_bundle.js') }}
        <!-- <script src="//oss.maxcdn.com/angular.strap/2.0.0/angular-strap.min.js"></script>
        <script src="//oss.maxcdn.com/angular.strap/2.0.0/angular-strap.tpl.min.js"></script> -->
        {{ HTML::script('scripts/bundle.js') }}
        @yield('scripts')
    </body>
</html>