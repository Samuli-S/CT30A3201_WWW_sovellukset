<?php
/**
 * Controller class for password handling.
 * 
 * This implementation was provided by the Laravel-framwork (not in visible 
 * use).
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller {

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * parameters:  void
     * returns:     void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
