<?php
/**
 * Controller class for authentication.
 * 
 * Authtenticates registered users and controls registration.
 * 
 * This implementation was provided by the Laravel-framwork (has been slightly
 * altered).
 */

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = 'user-home';

    /*
     * Create a new authentication controller instance.
     *
     * parameters:  void
     * returns:     void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * parameters:  data array
     * returns:     validator
     */
    protected function validator(array $data)
    {
        // Validator rules: http://laravel.com/docs/5.0/validation#rule-same
        
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',  // Appended
            'username' => 'required|max:255|unique:users', // Appended
            'email' => 'required|confirmed|email|max:255|unique:users', // Changed
            'password' => 'required|confirmed|min:8', // Changed
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * parameters:      data array
     * returns:         cretated User-model instance
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => strip_tags($data['first_name']),
            'last_name' => strip_tags($data['last_name']),
            'username' => strip_tags($data['username']),
            'email' => strip_tags($data['email']),
            'password' => bcrypt($data['password']),
        ]);
    }
}
