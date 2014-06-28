<header id="header" role="header">
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-md-offset-1">
				<h1 class="logo">
					<a href="{{ url('/') }}">

					</a>
				</h1>
			</div>
			<div class="col-md-8">
				<ul class="nav nav-pills pull-right hidden-xs">
					<li>
						@if (! Auth::check())
				  		<a href="{{ URL::to('login') }}"><i class="fa fa-sign-in fa-lg"></i> Login</a>
						@else
				  		<a href="{{ URL::to('logout') }}"><i class="fa fa-sign-out fa-lg"></i> Logout</a>
						@endif
				  	</li>
				</ul>
			</div>
		</div>
	</div>
</header>