{{-- 
	Private user page.

	Uses common practices presented at:
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

		<div class="page-header">
			<h3>Welcome to your personal page, <strong>{{ $firstName }}.</strong></h3>
		</div>
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
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">Community</h4>
					</div>
					<div class="panel-body">
						
						<button type="button" data-toggle="modal" data-target="#modal_1" class="btn btn-default pull-right">Upload Picture</button>
						@include('templates.store-picture-modal', array('modalID' => 'modal_1'))
						
						<a href="{{ $websiteBaseURL }}picture-preview" class="btn btn-default">View Pictures</a>
						<hr>
						<h4>Our Newest Users</h4>
						@foreach($newUsers as $new)
							<p>{{ $new->first_name }}</p>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-5 col-lg-offset-1">
				<div class="panel panel-default">
					<!--<div class="panel-heading">
						
					</div>-->
					<div class="panel-body">
						<ul class="nav nav-tabs nav-justified">
						  <li role="presentation" class="active"><a href="#me" aria-controls="me" data-toggle="pill">Me</a></li>
						  <li role="presentation"><a href="#settings" aria-controls="settings" data-toggle="pill"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
						</ul>
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="me">
								@if (!is_null($user->profile_picture_path))
									<div id="user_profile_pictur_container">
										<br />
										<img id="user_profile_picture_img" src="{{ $user->profile_picture_path }}" class="well" style="max-width: 10em;">
										<br />
									</div>
									<button id="change_profile_picture_btn" class="btn btn-default">Change Profile Picture</button>
								@else
									<div id="user_profile_pictur_container" style="display: none;">
										<img id="user_profile_picture_img" src="" style="max-width: 10em">
										<br />
										<br />
									</div>
									<br />
									<button id="change_profile_picture_btn" class="btn btn-default">Upload Profile Picture</button>
								@endif
								
								<div id="profile_picture_set_container" style="display: none;">
									<form id="profile_picture_dropzone" action="{{ $websiteBaseURL }}user-home/save-profile-picture" class="dropzone">
										{{ csrf_field() }}
									</form>
								</div>

								<br />
								<hr>

								<form action="" method="post">
									{{ csrf_field() }}

									<div class="form-group">
										<input type="hidden" value="username" name="post_type">

										<label for="username">Username</label>
										<div class="input-group">
											<input type="text" id="username" name="username" class="form-control" value="{{ $username }}">
											<span class="input-group-btn">
												<button type="submit" class="btn btn-default">Change</button>
											</span>
										</div>
									</div>
								</form>
								
									@if ($profileProgress < 100)
										<div id="profile_editing_container" style="">
										<h4>Complete your profile</h4>
									@else
										<button id="show_profile_editing_btn" class="btn btn-default">Edit Your Profile</button>
										<div id="profile_editing_container" style="display: none;">
										<h4>Edit your profile</h4>
									@endif
										<div class="well">
											<form action="" method="post">
												{{ csrf_field() }}
												<input type="hidden" value="profile" name="post_type">
												<div class="form-group">	
													<label for="country">Country</label>
													@if (is_null($country))
														@if (empty(old('country')))
															<input type="text" id="country" name="country" class="form-control">
														@else
															<input type="text" id="country" name="country" value="{{ old('country') }}" class="form-control">
														@endif
													@else
														<input type="text" id="country" name="country" value="{{ $country }}"class="form-control" placeholder="">
													@endif
												</div>
												<div class="form-group">
													<label for="city">City</label>
													@if (is_null($city))
														@if (empty(old('city')))
															<input type="text" id="city" name="city" class="form-control">
														@else
															<input type="text" id="city" name="city" value="{{ old('city') }}" class="form-control">
														@endif
													@else
														<input type="text" id="city" name="city" value="{{ $city }}" class="form-control" placeholder="">
													@endif
												</div>
												<div class="form-group">	
													<label for="gender">Gender</label>
													<br />
													@if (is_null($gender))
														@if (empty(old('gender')))
															<input type="radio" name="gender" value="male" checked> Male
															<input type="radio" name="gender" value="female"> Female
														@else
															@if (old('gender') == 'male')
																<input type="radio" name="gender" value="male" checked> Male
																<input type="radio" name="gender" value="female"> Female
															@else
																<input type="radio" name="gender" value="male"> Male
																<input type="radio" name="gender" value="female" checked> Female
															@endif
														@endif
													@else
														@if ($gender == 'male')
															<input type="radio" name="gender" value="male" checked> Male
															<input type="radio" name="gender" value="female"> Female
														@else
															<input type="radio" name="gender" value="male"> Male
															<input type="radio" name="gender" value="female" checked> Female
														@endif
													@endif
												</div>

												<button class="btn btn-default">Save</button>
											</form>
										</div>
									</div>
	
							</div>
							<div role="tabpanel" class="tab-pane fade" id="settings">
								<br />
								<!--<a href="user-delete" class="btn btn-danger pull-right">Delete Account</a>-->
								<button type="button" data-toggle="modal" data-target="#modal_2" class="btn btn-danger pull-right">Delete Account</button>
								@include('templates.delete-account-modal', array('modalID' => 'modal_2'))
							</div>
					  	</div>
					</div>
					@if ($profileProgress < 100)
						<div class="panel-footer">			
							<span class=""><strong>Your profile progress</stron></span>
							<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="{{ $profileProgress }}" aria-valuemin="0" aria-valuemax="100" style="width : {{ $profileProgress }}%; min-width: 1.5em">
									<span class="sr-only">{{ $profileProgress }} % complete</span>
									{{ $profileProgress }} %
								</div>
							</div>
						</div>	
					@else
						{{-- TODO: something to show here after profile has been finished--}}
					@endif	
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	@parent
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
	<script type="text/javascript" src="js/store-picture-modal.js"></script>
	<script type="text/javascript" src="js/delete-account-modal.js"></script>

	<script>

		// Switches button text.
		function changeBtnText(firstText, secondText, btn) {
			if(btn.text() == firstText) {
				btn.text(secondText);
			}
			else {
				btn.text(firstText);
			}
		}

		$('#show_profile_editing_btn').click(function() {
			$('#profile_editing_container').fadeToggle();
			changeBtnText('Edit Your Profile', 'Hide Profile Editing', $(this));
		});

		// Dropzone setup for profile picture.
		Dropzone.options.profilePictureDropzone = {
			dictDefaultMessage: 'Drop your profile picture here!',
			maxFilesize: 3,
			maxFiles: 1,

			success: function(file, responseText) {
				$('#profile_picture_set_container').fadeOut();
				$('#user_profile_picture_img').attr('src', responseText.profile_picture_path);
				$('#user_profile_pictur_container').css('display', 'block');
				$('#change_profile_picture_btn').text('Change Profile Picture');

				this.removeAllFiles();
			}
		};
		$('#change_profile_picture_btn').click(function() {
			$('#profile_picture_set_container').fadeToggle();
			changeBtnText('Change Profile Picture', 'Hide Drop Area', $(this));
		});
	</script>
@endsection