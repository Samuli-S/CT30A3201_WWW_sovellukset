{{-- 
	Template user account deletion.

	This modal is used for ensuring that the user wishes to delete his or her account.
	It is tightly connected to the 'remove-account-modal.js'-Javascript file (predefined IDs) and the
	mentioned file should always be included with this template.

	Uses practices presented at:
	http://www.w3schools.com/bootstrap/bootstrap_modal.asp
--}}

{{-- This is available incase the url for this website changes (dev environment changes) --}}
<?php $websiteBaseURL = 'https://ct30a3201-2015-siitonen-samuli-s.c9users.io/'; ?>

<div id="{{ $modalID }}" role="delete account dialog" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" data-dismiss="modal" class="close"><span class="glyphicon glyphicon-remove"></span></button>
				<h4 class="modal-title">Account Removal</h4>
			</div>
			<div class="modal-body">
				<!-- Error message: user failed to write 'DELETE' correctly -->
				<div id="delete_account_modal_error_container" style="display: none;">
					<div class="alert alert-danger text-center">
						<h4>You must write 'DELETE' into the given input field in order to delete your account.</h4>
					</div>
				</div>
				<div class="form-group">
					<label for="header">Write 'DELETE' in order to continue to the last phase.</label>
					<input id="delete_account_modal_input" type="text" name="header" class="form-control">
				</div>
				<button id="delete_account_modal_open_container_btn" type="button" class="btn btn-warning">Continue</button>
				<div id="delete_account_modal_container" style="display: none;">
					{{-- Final account deletion control. --}}
					<hr>
					<span class="label label-danger"><span class="glyphicon glyphicon-warning-sign"></span> Account will be fully deleted.</span>
					<br />
					<br />
					<a href="user-delete" class="btn btn-danger">Delete Account</a>
				</div>
			</div>
		</div>
	</div>
</div>