{{-- 
	Private user page.

	Uses common practices defined at:
	http://getbootstrap.com/
	http://laravel.com/docs/5.1/blade
	http://getbootstrap.com/javascript/#mdo
--}}

{{-- This is available incase the url for this website can changee (switch dev-environment) --}}
<?php $websiteBaseURL = 'https://ct30a3201-2015-siitonen-samuli-s.c9users.io/'; ?>

@extends('templates.master-nav-linked')

@section('header')
	@parent

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.css">
@endsection

@section('title-text')
	Home
@endsection

@section('content')
	<div class="container">
		<ul class="nav nav-tabs nav-justified">
			@if($activeTab == 'about')
			    <li role="presentation" class="active"><a href="#about" aria-controls="about" data-toggle="pill">About</a></li>
			    <li role="presentation"><a href="#contact" aria-controls="contact" data-toggle="pill">Contact</a></li>
			    <li role="presentation"><a href="#legal" aria-controls="legal" data-toggle="pill">Legal</a></li>
			@elseif($activeTab == 'contact')
				<li role="presentation"><a href="#about" aria-controls="about" data-toggle="pill">About</a></li>
			    <li role="presentation" class="active"><a href="#contact" aria-controls="contact" data-toggle="pill">Contact</a></li>
			    <li role="presentation"><a href="#legal" aria-controls="legal" data-toggle="pill">Legal</a></li>
			@else
				<li role="presentation"><a href="#about" aria-controls="about" data-toggle="pill">About</a></li>
			    <li role="presentation"><a href="#contact" aria-controls="contact" data-toggle="pill">Contact</a></li>
			    <li role="presentation" class="active"><a href="#legal" aria-controls="legal" data-toggle="pill">Legal</a></li>
		    @endif
		</ul>

		<div class="tab-content">
			<br />
			<div role="tabpanel" class="tab-pane fade in active" id="about">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				<span class="label label-info">proident</span>, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco <span class="label label-info">laboris</span> nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. <span class="label label-info">Duis</span> aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="contact">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. <span class="label label-info">Duis</span> aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				<span class="label label-info">proident</span>, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="legal">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut <span class="label label-info">aliquip</span> ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco <span class="label label-info">laboris</span> nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
  		</div>
	</div>
@endsection

@section('script')
	@parent

@endsection