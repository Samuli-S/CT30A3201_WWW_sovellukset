{{-- 
	Template for store picture modal.

	This modal is used for storing pictures into server storage.
	It is tightly connected to the 'store-picture-modal.js'-Javascript file 
	(predefined IDs) and the mentioned file should always be included with this 
	template.

	Uses practices presented at:
	http://www.w3schools.com/bootstrap/bootstrap_modal.asp
--}}

{{-- This is available incase the url for this website changes (dev environment changes) --}}
<?php $websiteBaseURL = 'https://ct30a3201-2015-siitonen-samuli-s.c9users.io/'; ?>

<div id="{{ $modalID }}" role="add picture dialog" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" data-dismiss="modal" class="close"><spann class="glyphicon glyphicon-remove"></span></button>
				<div class="row">
					<div class="col-xs-12 hidden-sm hidden-md hidden-lg">
						<h4 class="modal-title">Upload pictures</h4>
					</div>
					<div class="col-sm-12 hidden-xs">
						<h4 class="modal-title">Upload your favorite pictures</h4>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<!-- Success messages: stored a picture successfully -->
				<div id="store-picture-modal-success_container" style="display: none;">
					<div class="alert alert-success text-center">
						<div class="row">
							<div class="col-xs-12 hidden-sm hidden-md hidden-lg">
								<h4>Upload successful</h4>
							</div>
							<div class="col-sm-12 hidden-xs">
								<h4>Your file has been successfully uploaded. Wish to add another one?</h4>
							</div>
						</div>
					</div>
				</div>
				<!-- Error messages: failed to store picture -->
				<div id="store-picture-modal-error_container" style="display: none;">
					<div class="alert alert-danger text-center">
						<h4>It seems that something went wrong :(</h4>
						<ul id="store_picture_modal_error_list"></ul>
					</div>
				</div>
				{{-- Main user interaction for file transfer. --}}
				<form id="store_picture_modal_form" action="{{ $websiteBaseURL }}picture/save" role="form" class="dropzone">
					{{ csrf_field() }}
					
					<div class="dropzone-previews"></div>

					<div class="form-group">
						<label for="header">Header <span class="glyphicon glyphicon-asterisk"></span></label>
						<input id="store_picture_header" type="text" name="header" class="form-control">
					</div>
					<div class="form-group">
						<label for="description">Description</span></label> 
						<textarea id="store_picture_description" name="description" class="form-control" rows="5"></textarea>
					</div>
					<div class="form-group">
						
						{{-- Include template for picture categories dropdown. Requires ID parameters for category button and categories. --}}
						@include('templates.pic-categories-template', array('dropdownBtnID' => 'pic_cat_dropdown_btn', 'dropdownTextID' => 'pic_cat_dropdown_text', 'firstCategoryID' => 'first_pic_cat', 'secondCategoryID' => 'second_pic_cat', 'thirdCategoryID' => 'third_pic_cat', 'showRequiredSymbol' => true))
						
						<input id="store_picture_category" type="hidden" name="category" value="" class="form-control">
					</div>
					<br>
					<hr>
				</form>
			</div>
			{{-- Modal controls. --}}
			<div class="modal-footer">
				<div class="row">
					<div class="col-xs-12 hidden-sm hidden-md hidden-lg">
						<button id="store_picture_btn" type="button" class="btn btn-success pull-right">Upload  <span class="glyphicon glyphicon-save"><span></button>
						<button id="reset_store_picture_area_btn" type="button" class="btn btn-danger pull-left">Reset Upload</button>
					</div>
					<div class="col-sm-12 hidden-xs">
						<button id="store_picture_btn_mobile" type="button" class="btn btn-success pull-right">Upload Picture <span class="glyphicon glyphicon-save"><span></button>
						<button id="reset_store_picture_area_btn_mobile" type="button" class="btn btn-danger pull-left">Reset Picture Area</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>