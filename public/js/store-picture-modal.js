/**
 * Javascript file (JQuery) for picture storing modal.
 *
 * Reacting to modal button presses and sending AJAX-requests with new picture data.
 *
 * Tightly connected to the 'store-picture-modal.blade.php' blade template file (predefined IDs).
 * 
 * Requires Dropzone.js library to be included in the page that uses store picture modal:
 * http://www.dropzonejs.com/
 *
 * Most notable sources used:
 * https://github.com/enyo/dropzone/wiki/Combine-normal-form-with-Dropzone 
 * http://www.dropzonejs.com/#configuration
 * http://www.scriptscoop.net/t/d149c96e9e26/javascript-dropzone-js-file-upload-file-remove-not-working.html
 * http://stackoverflow.com/questions/19390471/dropzonejs-how-to-get-php-response-after-upload-success
 */

/**
 * Reset form values.
 *
 * parameter:	void
 * returns: 	void 
 */
function resetStorePictureModalForm() {
	$('#store_picture_header').val('');
	$('#store_picture_description').val('');
	$('#store_picture_category').val('');
}

/**
 * Print errors into error list and set it visible on the page (modal).
 *
 * parameter:	json array errors
 * returns: 	void 
 */
function printStorePictureModalErrors(errors) {
	$('#store_picture_modal_error_list').empty();

	// Print error list items.
	jQuery.each(errors, function(index, value) {
	    console.log(value);
	    $('#store_picture_modal_error_list').append('<li>' + value + '</li>');
	});
	$('#store-picture-modal-error_container').fadeToggle();  // Show error container.
}

/**
 * Listener for modal picture category selection.
 *
 * Sets picture category selection to be visible in the dropdown. 
 * Also sets picture category dropdown value to a hidden form element inside the
 * modal for storing pictures.
 */
$('#first_pic_cat,#second_pic_cat,#third_pic_cat').click(function() {
	var selectedCategory = $(this).text();

	$('#pic_cat_dropdown_text').text(selectedCategory);
	$('#store_picture_category').val(selectedCategory);
});

/**
 * Setting up the dropzone (form) that allows users to upload pictures trough AJAX-requests.
 */
 Dropzone.options.storePictureModalForm = {
 	
	autoProcessQueue: false,
	uploadMultiple: false,
	parallelUploads: 10,
	maxFiles: 1,  // Single files with header, description and category.
	maxFilesize: 3, // Max size 3000 kb

	// Disallow clicks: clicking outside form input inside the form doesn't pronmt file upload.
	clickable: false,

	// Initialization of the dropzone: start listening for dropzone events.
	init: function() {
		console.log('init');
		var modalDropzone = this;

		$('#store_picture_btn,#store_picture_btn_mobile').click(function(event) {
			$('#store-picture-modal-error_container').fadeOut();
			$('#store-picture-modal-success_container').fadeOut();
			console.log('send');

			event.preventDefault();
			event.stopPropagation();

			modalDropzone.processQueue();					
		});

		$('#reset_store_picture_area_btn,#reset_store_picture_area_btn_mobile').click(function() {
			modalDropzone.removeAllFiles();
		});

		this.on('complete', function(file, response) {
			modalDropzone.removeAllFiles();
			resetStorePictureModalForm();
		});

	    this.on('success', function(files, reponse) {
	    	$('#store-picture-modal-success_container').fadeIn();

	    	$('#pic_cat_dropdown_text').text('Pic Categories');
			$('#store_picture_category').val('');
	    });

	    this.on('error', function(files, response) {
	    	printStorePictureModalErrors(response);
	    });
	}
}
