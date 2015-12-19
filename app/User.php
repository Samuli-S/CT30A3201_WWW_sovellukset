<?php
/**
 * Model class for performing database operation (Laravel eloquent model).
 * Is connected to a database table trough naming convention: plurarity
 * signifies a database table and the model name is in singular form.
 * 
 * This model was provided by Laravel-framework (it has been altered).
 */
namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /*
     * The database table used by the model.
     */
    protected $table = 'users';

    /*
     * The attributes that are mass assignable.
     */
    protected $fillable = ['first_name', 
                            'last_name', 
                            'email',
                            'username', 
                            'password'];

    /*
     * The attributes excluded from the model's JSON form.
     */
    protected $hidden = ['password', 'remember_token'];
}
