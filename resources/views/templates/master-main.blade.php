{{-- 
	Main blade-template that will be used for most (common) pages.

	Uses common practices presented at:
	http://getbootstrap.com/
	http://laravel.com/docs/5.1/blade

	includes (CDN):
	- Bootstrap-framework (CSS and JavaScript)
	- JQuery JavaScript library
--}}

{{-- This is available incase the url for this changes (switch dev-environment) --}}
<?php $websiteBaseURL = 'https://ct30a3201-2015-siitonen-samuli-s.c9users.io/'; ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="csrf_token" content="{!! csrf_token() !!}">

		@yield('main-head-append')

		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		@yield('main-title')
	</head>
	<body>
		<header>
			@yield('main-header')
		</header>

		@yield('main-content')
		<footer>
			<br />
			<br />
			<br />
			<div class="navbar navbar-default navbar-fixed-bottom">
				<div class="container">
					<div class="row">
						{{-- Footer for bigger screens. --}}
						<div class="col-sm-9 hidden-xs">
							<div class="row">
								<div class="col-sm-3">
									<a href="{{ $websiteBaseURL }}website-information/about">About</a>
								</div>
								<div class="col-sm-3">
									<a href="{{ $websiteBaseURL }}website-information/contact">Contact</a>
								</div>
								<div class="col-sm-3">
									<a href="{{ $websiteBaseURL }}website-information/legal">Legal</a>
								</div>
							</div>
						</div>

						{{-- Footer for mobile. --}}
						<div class="col-xs-2 hidden-sm hidden-md hidden-lg">
							<a href="{{ $websiteBaseURL }}website-information/about">About</a>
						</div>
						<div class="col-xs-2 col-xs-offset-2 hidden-sm hidden-md hidden-lg">
							<a href="{{ $websiteBaseURL }}website-information/contact">Contact</a>
						</div>
						<div class="col-xs-1 col-xs-offset-3 hidden-sm hidden-md hidden-lg">
							<a href="{{ $websiteBaseURL }}website-information/legal">Legal</a>
						</div>
					
					</div>
					<div class="pull-right">
						<strong>Copyright © 2015 All rights reserved.</strong>
					</div>
				</div>
			</div>
		</footer>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		{{-- 
		Required csrf-token in AJAX-request header (Laravel-framework checks this on all request types) 
		From source:
		http://stackoverflow.com/questions/30154112/laravel-5-simple-ajax-retrieve-record-from-database
		--}}
		<script>
			$.ajaxSetup({
	    		headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
			});
		</script>

		@yield('main-script')

	</body>
</html>