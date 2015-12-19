{{-- 
	Secondary blade-template that will be used at most pages.
	Shows navigation bar links.

	Uses common practices presented at:
	http://getbootstrap.com/
	http://laravel.com/docs/5.1/blade
--}}

{{-- This is available incase the url for this website can changee (switch dev-environment) --}}
<?php $websiteBaseURL = 'https://ct30a3201-2015-siitonen-samuli-s.c9users.io/'; ?>

@extends('templates.master-main')

@section('main-head-append')
	@parent {{-- Include parent structure (no re-write) --}}

	{{-- Allows mobile users to zoom by touch. --}}
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@yield('header')
@endsection

@section('main-title')
	<title>Welcome - @yield('title-text')</title>
@endsection

@section('main-header')
	{{-- Presented at http://getbootstrap.com/components/#navbar --}}
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">    
		    <div class="navbar-header">
		    	<a class="navbar-brand" href="{{ $websiteBaseURL }}">PicApplication</a>
		      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigatior-bar" aria-expanded="false">
		        	<span class="sr-only">Toggle navigation</span>
		        	<span class="icon-bar"></span>
		        	<span class="icon-bar"></span>
		        	<span class="icon-bar"></span>
		      	</button>
		    </div>
		    <div class="collapse navbar-collapse" id="navigatior-bar">
		    	{{-- Main links. --}}
				<ul class="nav navbar-nav">
					@if ($activePageLink == 'user-home')
						<li class="active"><a href="{{ $websiteBaseURL }}user-home">Home<span class="sr-only">(current)</span></a></li>
						<li><a href="{{ $websiteBaseURL }}picture-preview">Pictures</a></li>
					@elseif ($activePageLink == 'picture-preview')
						<li><a href="{{ $websiteBaseURL }}user-home">Home<span class="sr-only">(current)</span></a></li>
						<li class="active"><a href="{{ $websiteBaseURL }}picture-preview">Pictures</a></li>
					@else
						<li><a href="{{ $websiteBaseURL }}user-home">Home</a></li>
						<li><a href="{{ $websiteBaseURL }}picture-preview">Pictures</a></li>
					@endif
				</ul>
				<span class="navbar-text pull-right">Signed In: {{ Auth::user()->email }} | <a href="{{ $websiteBaseURL }}auth/logout" class="navbar-link">Log Out</a></span>
			</div>
		</div>
	</nav>
@endsection

@section('main-content')
	@yield('content')

@endsection

@section('main-script')
	@parent  {{-- Include parent structure (no re-write) --}}

	@yield('script')
@endsection