{{-- 
	Secondary blade-template that will be used most notably at sign in and 
	register pages. Does not show navigation bar links, except for the sign in 
	(website name) page.

	Uses common practices presented at:
	http://getbootstrap.com/
	http://laravel.com/docs/5.1/blade
--}}

@extends('templates.master-main')

@section('main-head-append')
	@parent {{-- Include parent structure (no re-write) --}}

	{{-- Allows mobile users to zoom by touch. --}}
	<meta name="viewport" content="width=device-width, initial-scale=1">
@endsection

@section('main-title')
	<title>Welcome - @yield('title-text')</title>
@endsection

@section('main-header')
	{{-- Presented at http://getbootstrap.com/components/#navbar --}}
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">    
		    <div class="navbar-header">
		    	<a class="navbar-brand" href="/">PicApplication</a>
		    </div>
		</div>
	</nav>
@endsection

@section('main-content')
	<div class="container">
	@yield('content')
	</div>
@endsection

@section('main-script')
	@parent  {{-- Include parent structure (no re-write) --}}

	@yield('script')
@endsection