{{-- 
	Page for indiviual picture (picture details: views, likes, dislikes, comments
	and so on).

	Uses common practices presented at:
	http://getbootstrap.com/
	http://laravel.com/docs/5.1/blade
	http://laravel-recipes.com/recipes/90/including-a-blade-template-within-another-template
--}}

{{-- This is available incase the url for this website changes (dev environment changes) --}}
<?php $websiteBaseURL = 'https://ct30a3201-2015-siitonen-samuli-s.c9users.io/'; ?>

@extends('templates.master-nav-linked')

@section('title-text')
	{{ $picture->header }}
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="hidden-xs col-sm-10 col-sm-offset-1">
				<div class="page-header">
					<h4>{{ $picture->header }}</h4>
				</div>
				{{-- File creator details. --}}
				<span class="glyphicon glyphicon-user"></span>
				<span class="label label-default">{{ $pictureOwnerUsername }}</span>
				<span class="glyphicon glyphicon-calendar"></span>
				<span class="label label-default">{{ $picture->created_at }}</span>
				<span  data-toggle="modal" data-target="#modal_1" class="btn btn-default pull-right">Upload Picture</span
				<br />
				<br />
				<br />
				<div class="text-center"><img src="/{{ $picture->path }}" alt="picture"></div>
				<p>{{ $picture->description }}</p>
				<br />
				{{-- Community related details. --}}
				<span class="glyphicon glyphicon-thumbs-down"></span>
				<span id="dislike_counter" class="label label-default">{{ $picture->dislikes }}</span>
				<span class="glyphicon glyphicon-thumbs-up"></span>
				<span id="like_counter" class="label label-default">{{ $picture->likes }}</span>
				<span class="glyphicon glyphicon-eye-open"></span>
				<span class="label label-default">{{ $picture->views }}</span>

				{{-- Picture voting. --}}
				<div class="pull-right">
					@if ($allowedToVotePicture)
						<button id="dislike_btn" type="button" value="dislike" class="btn btn-danger">Dislike</button>
						<button id="like_btn" type="button" value="like" class="btn btn-success">Like</button>
					@else
						<button id="dislike_btn" type="button" value="dislike" class="btn btn-danger" disabled>Dislike</button>
						<button id="like_btn" type="button" value="like" class="btn btn-success" disabled>Like</button>
					@endif
				</div>
			</div>
			<div class="col-xs-12 hidden-sm hidden-md hidden-lg">
				<div class="page-header">
					<h4>{{ $picture->header }}</h4>
				</div>
				<span class="glyphicon glyphicon-user"></span>
				<span class="label label-default">{{ $pictureOwnerUsername }}</span>
				<br>
				<span class="glyphicon glyphicon-calendar"></span>
				<span class="label label-default">{{ explode(' ', $picture->created_at)[0] }}</span>
				<br />
				<br />
				<br />
				<div class="text-center"><img src="/{{ $picture->path }}" alt="picture"></div>
				<p>{{ $picture->description }}</p>

				<br />
	
				{{-- Picture vote statistics. --}}
				<span class="glyphicon glyphicon-thumbs-down"></span>
				<span id="dislike_counter_mobile" class="label label-default">{{ $picture->dislikes }}</span>
				<span class="glyphicon glyphicon-thumbs-up"></span>
				<span id="like_counter_mobile" class="label label-default">{{ $picture->likes }}</span>
				<span class="glyphicon glyphicon-eye-open"></span>
				<span class="label label-default">{{ $picture->views }}</span>

				<div class="pull-right">
					@if ($allowedToVotePicture)
						<button id="dislike_btn_mobile" type="button" value="dislike" class="btn btn-danger">Dislike</button>
						<button id="like_btn_mobile" type="button" value="like" class="btn btn-success">Like</button>
					@else
						<button id="dislike_btn_mobile" type="button" value="dislike" class="btn btn-danger" disabled>Dislike</button>
						<button id="like_btn_mobile" type="button" value="like" class="btn btn-success" disabled>Like</button>
					@endif
				</div>
			</div>
		</div>
		<br />
		<br />
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
				{{-- New user comment is places in this container. --}}
				<label for="new_comment_container">Comment</span></label>
				<br />
				<textarea id="new_comment_container" class="form-control" rows="5"></textarea>
				<br />
				<button id="add_comment_btn" class="btn btn-default pull-right">Add Comment</button>
				<div class="dropdown pull-left">
					<button id="comments_pdf_action_dropdown" type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="true">
						<span>Comments To PDF</span>&nbsp;
						<span class="glyphicon glyphicon-chevron-down"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="comments_pdf_action_dropdown">
						<li><a id="comments_pdf_new_tab" href="#">Show In New Tab</a></li>
						<li><a id="comments_pdf_print" href="#">Print</a></li>
						<li><a id="comments_pdf_download" href="#">Download</a></li>
					</ul>
				</div>
				<br />
				<br />
				<br />
				<button id="show_comments_btn" type="button" class="btn btn-default">Show/Hide Comments</button>
				{{-- Old picture comments. --}}
				<div id="comments_container" style="display: none;">
					@foreach ($comments as $comment)
						<hr>
							<div class="media">
								<div class="media-left media-top">
									<span class="label label-default">{{ $comment->username }}</span>
									<br />
									@if(!is_null($comment->profilePicturePath))
										<img class="media-object" src="{{ $websiteBaseURL . $comment->profilePicturePath }}" alt="user profile picture" style="max-width: 10em;">
									@endif
								</div>
								<div class="media-body">
									<textarea class="form-control" rows="5" disabled>{{ $comment->comment }}</textarea>
								</div>
								<span class="pull-right">{{ $comment->created_at }}</span>
							</div>
					@endforeach
				</div>
			</div>
		</div>
		{{-- Store picture id for creating a new comment (comments are tied to pictures). --}}
		<input id="picture_id" type="hidden" value="{{ $picture->id }}">
		@include('templates.store-picture-modal', array('modalID' => 'modal_1'))
	</div>
@endsection

@section('script')
	@parent

	{{-- Allowd creation of pdf-files (comments) --}}
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.20/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.20/vfs_fonts.js"></script>

	{{-- For adding new files: dropzone and modal. --}}
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
	<script type="text/javascript" src="js/store-picture-modal.js"></script>

	<script>
	
		/*
		* Page envent listener (click) initialization.
		*/
		$('#show_comments_btn').click(function() {
			$('#comments_container').fadeToggle();
		});

		$('#comments_pdf_new_tab').click(function() {
			generateCommentsPdf('new_tab');
		});
			
		$('#comments_pdf_print').click(function() {
			generateCommentsPdf('print');
		});

		$('#comments_pdf_download').click(function() {
			generateCommentsPdf('download');
		});

		/**
		 * Function for generating pdf-files from comments and other information
		 * closely related to pictures.
		 * 
		 * parameter: 	pdf-action type
		 * returns:		void
		 */
		function generateCommentsPdf(actionType) {
			var commentTableHeader = [{text: 'Username', style: 'tableheader'},  {text: 'Comment', style: 'tableheader'}, {text: 'Timestamp', style: 'tableheader'}];
			var commentTableRows = [];
			commentTableRows.push(commentTableHeader);

			// Go trough all comments and store them.
			$('#comments_container .media').each(function() {
				var commentTextArea = $(this).find('textarea');
				var comment = commentTextArea.val();

				var userNameSpan = $(this).find('.label');
				var username = userNameSpan.text();

				var timestampDiv = $(this).find('.pull-right');
				var timestamp = timestampDiv.text();

				commentTableRows.push([username, comment, timestamp]);
			});
			
			// Create pdf-document definition: structure and inforamtion.
			var pdfDocumentDefinition = {
					content: [
						{text: 'Comments For a Picture', style: 'header'},
						{text: '\n' },
						'This pdf-file lists user comments for the selected picture page. Comment information consists of username, the comment itself and timestamp for the comment.',
						{text: '\n' },
						{text: 'Picture header: ' + '{{ $picture->header }}'},
						{text: 'Description (if any): ' + '{{ $picture->description }}'},
						{text: 'Category: ' + '{{ $picture->category }}'},
						{text: '\n' },
						{
							style: 'tableExample',
							table: {
								body: commentTableRows
							}
						},
					]
				}			

			// Execute action dictated by the user.
			if(actionType == 'new_tab') {
				pdfMake.createPdf(pdfDocumentDefinition).open();
			}
			else if(actionType == 'print') {
				pdfMake.createPdf(pdfDocumentDefinition).print();
			}
			else {
				pdfMake.createPdf(pdfDocumentDefinition).download('{{ $picture->header }}' + '.pdf');
			}
		}

		var pictureID = $('#picture_id').val();

		/*
		 * Send new comments to the server (AJAX/AJAJ).
		 */
		$('#add_comment_btn').click(function() {
			$('#comments_container').fadeIn();  // Comment container is hidden by default.

			var comment = $('#new_comment_container').val();
			if(comment.length > 2) {
				// Valid comment.
				
				$('#add_comment_btn').prop('disabled', true);

				$.post('{{ $websiteBaseURL }}picture-details/save-comment', {
					'picture_id': pictureID,
					'comment': comment}, 
					function(data) {
						createNewComment(data);
					},'json')
					.always(function() {
						$('#add_comment_btn').prop('disabled', false);
						// Allow adding new comments.
					})
					.done(function() {
						$('#new_comment_container').val('');
						// Clean the comment field.
					})
			}
		});
		/*
		* Dislike/like a picture -> send AJAX-request to server.
		*/
		$('#like_btn,#dislike_btn,#like_btn_mobile,#dislike_btn_mobile').click(function() {
			var buttonText = $(this).text();

			$.post('{{ $websiteBaseURL }}picture-details/vote-picture', {
				'picture_id': pictureID,
				'operation':$(this).attr('value')}, 
				function(data) {
					if(data.is_successful == true) {
						// User was allowed to vote a picture.
						
						$('#like_btn,#dislike_btn,#like_btn_mobile,#dislike_btn_mobile').prop('disabled', true);
						
						if(buttonText == 'Like') {
							var newCounterValue = parseInt($('#like_counter').text(), 10) + 1;
							$('#like_counter').text(newCounterValue);
							$('#like_counter_mobile').text(newCounterValue)
						}
						else {
							var newCounterValue = parseInt($('#dislike_counter').text(), 10) + 1;
							$('#dislike_counter').text(newCounterValue);
							$('#dislike_counter_mobile').text(newCounterValue);
						}
					}
				},'json')
		});

		/*
		* Create new comment by prepending it to the existing ones.
		*/
		function createNewComment(jsonComment) {
			var userProfilePicturePath = jsonComment.profile_picture_path;
			var userProfileImageElement;

			if(userProfilePicturePath != '') {
				userProfileImageElement = '<img class="media-object" src="' + '{{ $websiteBaseURL}}' + userProfilePicturePath + '" alt="user profile picture" style="max-width: 10em;">';
			}
			else {
				userProfileImageElement = '';
			}

			$('#comments_container').prepend('<hr><div class="media"><div class="media-left media-top"><span class="label label-default">' + jsonComment.username + '</span><br />' + userProfileImageElement + '</div><div class="media-body"><textarea class="form-control" rows="5" disabled>' + jsonComment.comment + '</textarea></div><div class="pull-right">' + jsonComment.created_at + '</div></div>');
		}

	</script>}
@endsection
