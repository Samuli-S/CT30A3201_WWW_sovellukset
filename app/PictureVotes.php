<?php
/**
 * Model class for performing database operation (Laravel eloquent model).
 * 
 * This implementation is based on Laravel provided documentation and
 * the use of artisan command line interface (generate basic model
 * structure).
 */
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class PictureVotes extends Model
{
	// This model Uses this table explicitly (overwrite default behavior).
    protected $table = 'picture_votes';
}
