/**
 * Javascript file (JQuery) for handling account deletion modal.
 *
 * Reacts to button presses and facilitates user account removal trough simple 
 * GET-request (willingness to delete account is ensured).
 *
 * Tightly connected to the 'delete-account-modal.blade.php' 
 * blade template (predefined IDs).
 */

$('#delete_account_modal_open_container_btn').click(function() {
	if($('#delete_account_modal_input').val() == 'DELETE') {
		$('#delete_account_modal_container').fadeIn();
	}
	else {
		$('#delete_account_modal_error_container').fafeOut();
		$('#delete_account_modal_error_container').fadeIn();
	}
});
