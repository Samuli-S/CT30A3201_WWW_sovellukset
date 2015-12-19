{{-- 
	Page for registering.
	Closely tied to the predone authentication and registeration implementation of Laravel:
	http://laravel.com/docs/5.1/authentication

	Uses common practices defined at:
	http://getbootstrap.com/
	http://laravel.com/docs/5.1/blade
	http://www.w3schools.com/bootstrap/bootstrap_carousel.asp
--}}

@extends('templates.master-nav-plain')

@section('title-text')
	Register
@endsection

@section('content')
	@parent  {{-- Include parent structure (no re-write) --}}

	{{-- Default Laravel error messaging --}}
	@if (count($errors) > 0)
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-4 col-md-6 col-md-offset-6 col-lg-4 col-lg-offset-8">
			<div class="alert alert-danger">
				<h4>It seems that something went wrong :(</h4>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	@endif
	{{-- Non-mobile registration (hidden for smaller screen sizes, includes tablets)--}}
	<div class="row">
		<div class="hidden-xs hidden-sm hidden-md col-lg-6">
			@include('templates.picture-carousel', array('picture' => $picture))
		</div>
		<div class="hidden-xs col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">Register</h4>
				</div>
				<div class="panel-body">
					<form method="post" role="form">
						{{ csrf_field() }}

						<div class="form-group">
							<label for="first-name">First Name <span class="glyphicon glyphicon-asterisk"></span></label>
							@if (empty(old('first_name')))
								<input type="text" id="fist-name" name="first_name" class="form-control">
							@else
								<input type="text" id="fist-name" name="first_name" value="{{ old('first_name') }}" class="form-control">
							@endif
						</div>
						<div class="form-group">
							<label for="last-name">Last Name <span class="glyphicon glyphicon-asterisk"></label>
							@if (empty(old('last_name')))
								<input type="text" id="last-name" name="last_name" class="form-control"> 
							@else
								<input type="text" id="last-name" name="last_name" value="{{ old('last_name') }}" class="form-control">
							@endif
						</div>
						<div class="form-group">
							<label for="email-first">Email <span class="glyphicon glyphicon-asterisk"></span></label>
							@if (empty(old('email')))
								<input type="email" id="email-first" name="email" class="form-control" placeholder="You will sign in with this">
							@else
								<input type="email" id="email-first" name="email" value="{{ old('email') }}"class="form-control">
							@endif
						</div>
						<div class="form-group">
							<label for="email-again">Email Again <span class="glyphicon glyphicon-asterisk"></span></label>
								<input type="email" id="email-again" name="email_confirmation" class="form-control">
						</div>
						<div class="form-group">
							<label for="username">Username <span class="glyphicon glyphicon-asterisk"></span></label>
							@if (empty(old('username')))
								<input type="text" id="username" name="username" class="form-control" placeholder="This will be your visible username">
							@else
								<input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}">
							@endif
						</div>
						<div class="form-group">
							<label for="password-first">Password <span class="glyphicon glyphicon-asterisk"></span></label>
							<input type="password" id="password-first" name="password" class="form-control">
						</div>
						<div class="form-group">
							<label for="password-again">Password Again <span class="glyphicon glyphicon-asterisk"></span></label>
							<input type="password" id="password-again" name="password_confirmation" class="form-control">
						</div>
						<button type="submit" id="register-btn-default" class="btn btn-success pull-right">Register Me <span class="glyphicon glyphicon-ok"></span></button>
					</form>
				</div>
				<div class="panel-footer">
					<a href="/auth/login" class="btn btn-default">Back To Sign In</a>

					{{-- Make panel footer display button correctly: http://stackoverflow.com/questions/23872755/bootstrap-pull-left-and-right-in-panel-footer-breaks-footer--}}
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

		{{-- Mobile registration (hidden for larger screen sizes)--}}
		<div class="hidden-sm hidden-md hidden-lg col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Register</strong></div>
				<div class="panel-body">
					<form method="post" role="form">
						{{ csrf_field() }}

						<div class="form-group">
							<label for="first-name">First Name <span class="glyphicon glyphicon-asterisk"></span></label> 
							<input type="text"  id="fist-name" name="first_name"class="form-control">
						</div>
						<div class="form-group">
							<label for="last-name">Last Name <span class="glyphicon glyphicon-asterisk"></label>
							<input type="text"  id="last-name" name="last_name" class="form-control"> 
						</div>
						<div class="form-group">
							<label for="email-first">Email <span class="glyphicon glyphicon-asterisk"></span></label>
							<input type="email" id="email-first" name="email" class="form-control" placeholder="You will sign in with this">
						</div>
						<div class="form-group">
							<label for="email-again">Email Again <span class="glyphicon glyphicon-asterisk"></span></label>
							<input type="email" id="email-again" name="email_confirmation" class="form-control">
						</div>
						<div class="form-group">
							<label for="username">Username <span class="glyphicon glyphicon-asterisk"></span></label>
							<input type="text" id="username" name="username" class="form-control" placeholder="This will be your visible username">
						</div>
						<div class="form-group">
							<label for="password-first">Password <span class="glyphicon glyphicon-asterisk"></span></label>
							<input type="password" id="password-first" name="password" class="form-control">
						</div>
						<div class="form-group">
							<label for="password-again">Password Again <span class="glyphicon glyphicon-asterisk"></span></label>
							<input type="password" id="password-again" name="password_confirmation" class="form-control">
						</div>
						<button type="submit" id="register-btn-mobile" class="btn btn-success pull-right">Register Me <span class="glyphicon glyphicon-ok"></span></button>
					</form>
				</div>
				<div class="panel-footer">
					<a href="/auth/login" class="btn btn-default">Back To Sign In</a>

					{{-- Make panel footer display button correctly: http://stackoverflow.com/questions/23872755/bootstrap-pull-left-and-right-in-panel-footer-breaks-footer--}}
					<div class="clearfix"></div>
				</div>
			</div>
		</div>		
	</div>
@endsection

@section('script')
	@parent  {{-- Include parent structure (no re-write) --}}

@endsection