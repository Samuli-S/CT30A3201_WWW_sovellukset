{{-- 
	Page for all pictures.

	Uses common practices defined at:
	http://getbootstrap.com/
	http://laravel.com/docs/5.1/blade
	http://laravel-recipes.com/recipes/90/including-a-blade-template-within-another-template
--}}

{{-- This is available incase the url for this website can changee (switch dev-environment) --}}
<?php $websiteBaseURL = 'https://ct30a3201-2015-siitonen-samuli-s.c9users.io/'; ?>

@extends('templates.master-nav-linked')

@section('title-text')
	Pictures
@endsection
@include('templates.store-picture-modal', array('modalID' => 'modal_1'))
@section('content')
	<div class="container">
		<div class="page-header">
			<h2>Browse Pictures<small><span id="category_header"></span></small></h2>
		</div>
		<div class="row">
			<div class="col-xs-4 col-sm-4 col-md- col-md-2 col-lg-1">
				{{-- Include template for picture categories dropdown. Requires ID parameters for category button and categories. --}}
				@include('templates.pic-categories-template', array('dropdownBtnID' => 'pic_dropdown_btn', 'dropdownTextID' => 'pic_dropdown_text_id', 'firstCategoryID' => 'first_cat', 'secondCategoryID' => 'second_cat', 'thirdCategoryID' => 'third_cat', 'showRequiredSymbol' => false))
			</div>
				<div class="col-xs-4 col-sm-4 col-md- col-md-2 col-lg-1 pull-right">
				<button type="button" data-toggle="modal" data-target="#modal_1" class="btn btn-default pull-right">Upload Picture</button>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-12 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2">
				<div id="picture_container">

				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	@parent

	{{-- 
		Reacting to picture category select 
		source used:
	http://stackoverflow.com/questions/10734749/how-make-ajax-request-with-clicking-in-the-link-not-submit-button
	--}}

	<script>

	// Make sure that the page is not empty at arrival.
	$(document).ready(function() {
		populatePictureContainer('Funny');
	});

	//Serch for new pictures and add them to container.
	function populatePictureContainer(selectedCategory) {
		$('#category_header').text(' - ' + selectedCategory);
		$('#pic_dropdown_text_id').text(selectedCategory);
		$('#picture_container').empty();

		//Get all pictures for a selected category (AJAX-post request).
		$.post('/picture/find-by-category', {'category': selectedCategory}, function(data) {
			var rowImageCounter = 0;
			var rowCounter = 0;
			var currentRowID = 'pic_row_' + rowCounter;
			var currentPictureID;
			$('#picture_container').append('<div id="' + currentRowID + '" class="row"></div>');
			$.each(data, function(index, value) {
				currentPictureLink = '{{$websiteBaseURL}}picture-details/' + value.id;

				if(rowImageCounter < 4) {
					$('#' + currentRowID).append('<div class="col-xs-10 col-sm-6 col-md-4 col-lg-4"><a href="' + currentPictureLink + '" class="thumbnail"><img src="' + value.path + '" alt="picture" title="' + value.header + '"><span class="glyphicon glyphicon-eye-open"></span>' + value.views + '<span class="pull-right"><span class="glyphicon glyphicon-thumbs-up"></span>' + value.likes + ' <span class="glyphicon glyphicon-thumbs-down"></span> ' + value.dislikes + '</span></a></div>');
					rowImageCounter++;
				}
				else {
					rowCounter++;
					currentRowID = 'pic_row_' + rowCounter;
					$('#picture_container').append('<div id="' + currentRowID + '" class="row"></div>');

					$('#' + currentRowID).append('<div class="col-xs-10 col-sm-6 col-md-4 col-lg-5"><a href="' + currentPictureLink + '" class="thumbnail"><img src="' + value.path + '" alt="picture" title="' + value.header + '"><span class="glyphicon glyphicon-eye-open"></span>' + value.views + '<span class="pull-right"><span class="glyphicon glyphicon-thumbs-up"></span>' + value.likes + ' <span class="glyphicon glyphicon-thumbs-down"></span> ' + value.dislikes + '</span></a></div>');
					rowImageCounter = 1;
				}
			});
		}, 'json');
	}

	// Select picture category (uses ID selectors incase a new dropdown is introduced into the page)
	$('#first_cat,#second_cat,#third_cat').click(function() {
		//var selectedCategory = $(this).text();
		populatePictureContainer($(this).text());
	});
	</script>

@endsection

@section('script')
	@parent

	{{-- Dropzone and picture modal for adding new pictures (JS). --}}
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
	<script type="text/javascript" src="js/store-picture-modal.js"></script>
@endsection