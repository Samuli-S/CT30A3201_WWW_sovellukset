<?php
/**
 * Model class for performing database operation (Laravel eloquent model).
 * Is connected to a database table trough naming convention: plurarity
 * signifies a database table and the model name is in singular form.
 * 
 * This implementation is based on Laravel provided documentation and
 * the use of artisan command line interface (generate basic model
 * structure).
 */
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    // No imminent needs for more logic (implementation hidden in abstraction).
}
