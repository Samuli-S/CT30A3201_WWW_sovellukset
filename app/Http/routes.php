<?php
/**
 * Routing for all incoming requests. 
 *
 * Does prelimary processing and then
 * transfers control to varying controllers.
 *
 * The base structure for this file has been offered predone by the 
 * Laravel-framework.
 *
 * Laravel authentication and registration is presented at:
 * http://laravel.com/docs/5.1/authentication
 * (documentation about Laravel offered authentication/registration)
 * 
 * Note: this implementation uses predone Laraval sublied authentication that 
 * has been adjusted/modified.
 */

/*
 * Use Home page routes for showing the page, updating user information and 
 * deleting the user.
 */
Route::get('/', 'UserHomeController@show');
Route::get('user-delete', 'UserHomeController@destroy');
Route::get('user-home', 'UserHomeController@show');
Route::post('user-home', 'UserHomeController@update');
Route::post('user-home/save-profile-picture', 'UserHomeController@saveProfilePicture');

/*
 * Route for showing a picture review of multiple pictures.
 */
Route::get('picture-preview', 'PicturePreviewController@show');

/*
 * Route for showing a page that displays web application specific information
 * (About, Contact and Legal).
 */
Route::get('website-information/{target}', 'WebsiteInformationController@show');

/*
 * Routes for saving pictures and searching them by category.
 */
Route::post('picture/save', 'PictureController@save');
Route::post('picture/find-by-category', 'PictureController@findByCategory');

/*
 * Routes for showing the picture details page (one picture, votes and 
 * comments), saving a picture comment and voting on a picture.
 */
Route::get('picture-details/{id}', 'PictureDetailsController@showPictureDetails');
Route::post('picture-details/save-comment', 'PictureDetailsController@savePictureComment');
Route::post('picture-details/vote-picture', 'PictureDetailsController@votePicture');

/*
 * Not in use. Follows a basic Phaser tutorial (and does not work).
 *
Route::get('game', function() {
  return view('game', ['activePageLink' => 'pictures']);
});

/*
 * Authentication routes. These are part Laravel-offered authentication
 * (login view is self made).
 */ 
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

/*
 * Registration routes. These are part Laravel-offered authentication
 * (registration view is self made).
 */
 Route::get('auth/register', 'Auth\AuthController@getRegister');
 Route::post('auth/register', 'Auth\AuthController@postRegister');
