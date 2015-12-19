{{-- 
	Page for logging in.
	Closely tied to the predone authentication and registeration implementation of Laravel:
	http://laravel.com/docs/5.1/authentication

	Uses common practices defined at:
	http://getbootstrap.com/
	http://laravel.com/docs/5.1/blade
--}}

@extends('templates.master-nav-plain')

@section('title-text')
	Sign In
@endsection

@section('content')
	@parent  {{-- Include parent structure (no re-write) --}}

	{{-- Default Laravel error messaging --}}
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<h4>It seems that something went wrong :(</h4>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="row">
		{{-- Extra information for non-mobile sign in (includes tablets)--}}
		<div class="hidden-xs col-sm-5 col-md-7 col-lg-8">
			<div class="page-header">
			<h3>Welcome to PicApplication!</h3>
			</div>
			<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>

		</div>

		{{-- Non-mobile sign in (hidden for smaller screen sizes, includes tablets)--}}
		<div class="hidden-xs col-sm-7 col-md-5 col-lg-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">Sign In</h4>
				</div>
				<div class="panel-body">
					<button type="button" class="btn btn-default">Sign In With Facebook</button>
					<button type="button" class="btn btn-default">Sign In With Google</button>
					<br /><br />
					<form method="post" role="form">
						{{ csrf_field() }} {{-- Prevent Cross Site Request Forgery --}}

						<div class="form-group">
							<label for="email-default">Email Address</label>
							@if (empty(old('email')))
								<input type="email" id="email-default" name="email" class="form-control"> 
							@else
								<input type="email" id="email-default" name="email" value="{{ old('email') }}" class="form-control">
							@endif
						</div>
						<div class="form-group">
							<label for="password-default">Password</label>
							<input type="password" id="password-default" name="password" class="form-control">
						</div>
						<button type="submit" class="btn btn-primary pull-right">
							Sign In <span class="glyphicon glyphicon-chevron-right"></span>
						</button>
					</form>
				</div>
				<div class="panel-footer">
					<h4><span class="label label-info">Don't have an account?</span></h4>
					<a href="/auth/register" class="btn btn-default">Register</a>

					{{-- 
						Make panel footer display button correctly: 
						http://stackoverflow.com/questions/23872755/bootstrap-pull-left-and-right-in-panel-footer-breaks-footer
					--}}
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

		{{-- Mobile sign in (hidden for larger screen sizes)--}}
		<div class="hidden-sm hidden-md hidden-lg col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Sign In</strong></div>
				<div class="panel-body">
						<button type="button" class="btn btn-default">Sign In With Facebook</button>
						<button type="button" class="btn btn-default">Sign In With Google</button>
					<br /><br />
					<form method="post" role="form">
						{{ csrf_field() }}  {{-- Prevent Cross Site Request Forgery --}}

						<div class="form-group">
							<label for="email-mobile">Email Address</label>
							<input type="email" id="email-mobile" name="email" class="form-control"> 
						</div>
						<div class="form-group">
							<label for="password-mobile">Password</label>
							<input type="password" id="password-mobile" name="password" class="form-control">
						</div>
						<button type="submit" class="btn btn-primary pull-right">Sign In</button>
					</form>
				</div>
				<div class="panel-footer">
					<h5><span class="label label-info">Don't have an account?</span></h5>
					<a href="/auth/register" class="btn btn-default">Register</a>

					{{-- 
						Make panel footer display button correctly: http://stackoverflow.com/questions/23872755/bootstrap-pull-left-and-right-in-panel-footer-breaks-footer
					--}}
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	@parent  {{-- Include parent structure (no re-write) --}}
@endsection