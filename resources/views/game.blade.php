{{-- 
	JavaScript (Phaser-library) game page.


--}}

{{-- This is available incase the url for this website can changee (switch dev-environment) --}}
<?php $websiteBaseURL = 'https://ct30a3201-2015-siitonen-samuli-s.c9users.io/'; ?>

@extends('templates.master-nav-linked')

@section('header')
	@parent

@endsection

@section('title-text')
	Home
@endsection

@section('content')
	<div class="container">
	    <canvas id="game_canvas"></canvas>
	</div>
@endsection

@section('script')
	@parent
	<script type="text/javascript" src="js/phaser.min.js"></script>
	<script type="text/javascript" src="js/game.js"></script>
@endsection