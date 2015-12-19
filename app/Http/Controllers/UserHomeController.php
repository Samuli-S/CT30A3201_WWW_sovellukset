<?php
/**
 * Controller class for a user spesific page (Home-page). 
 * 
 * Facilitates the changing of user information (profile picture, personal
 * details and username) and removal of the user account trough provided
 * page controls.
 * 
 * This implementation is based on Laravel provided documentation and
 * the use of artisan command line interface (generate basic controller
 * structure).
 */

namespace App\Http\Controllers;

use App\User;

use Cache;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserHomeController extends Controller {
    /*
     * Users must have authorization in order to visit the home page.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Saves user profile picture (information about the profile picture: 
     * where it will be saved).
     *
     * parameters:   http-request
     * returns:     new profile picture path in json-format
     */
    public function saveProfilePicture(Request $request) {
        // Note the allowed file types.
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,png,image/jpeg,image/png|max:3000'
        ]);

        $file = $request->file('file');  // Actual user profile picture.

        // Unique filename based on current time in milliseconds (uniqid)
        $filename = uniqid() . strip_tags($file->getClientOriginalName());

        // Move picture to storage.
        $file->move('pictures/profiles', $filename);
        
        // Save picture filepath (tied to user).
        $filePath = 'pictures/profiles/' . $filename;
        $user = User::find(Auth::user()->id);
        $user->profile_picture_path = $filePath;
        $user->save();

        return response()->json(['profile_picture_path' => $filePath]);
    }

    /**
     * Shows the user home page. Transfer user information so that the user
     * can control his or her profile on this web application.
     *
     * parameters:   void
     * returns:     view for user home page (appended with information)
     */
    public function show() {
        $user = User::find(Auth::user()->id);
        
        $newUsers = $this->checkNewUsersCache();

        return view('user-home', 
                    ['activePageLink' => 'user-home', 
                    'profileProgress' => $this->getUserProfileProgress($user),
                    'username' => $user->username,
                    'firstName' => $user->first_name,
                    'country' => $user->country,
                    'city' => $user->city,
                    'gender' => $user->gender,
                    'user' => $user,
                    'newUsers' => $newUsers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Updates user username or profile information based on given parameters.
     *
     * parameters:   http-request
     * returns:     a new view with updated user information 
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);  // Current user.

        if($request->post_type == 'username') {
            // User wishes to change username
            
            $this->validate($request, [
                'username' => 'required|max:255|unique:users'
            ]);

            $user->username = strip_tags($request->username);
            $user->save();  // Database insert into the users-table.

            Auth::user()->username = $request->username;
        }
        else if($request->post_type == 'profile') {
            // User wishes to change profile information.
            
            // Validation error will cause json-response sendoff.
            $this->validate($request, [
                'country' => 'required|max:255',
                'city' => 'required|max:255',
                'gender' => 'required|max:255',
            ]);
            
            $newUsers = $this->checkNewUsersCache();

            $user->country = strip_tags($request->country);
            $user->city = strip_tags($request->city);
            $user->gender = strip_tags($request->gender);
            $user->save();  // Database insert into the users-table.
        }

        return view('user-home', 
                    ['activePageLink' => 'user-home', 
                    'profileProgress' => $this->getUserProfileProgress($user),
                    'username' => $user->username,
                    'firstName' => $user->first_name,
                    'country' => $user->country,
                    'city' => $user->city,
                    'gender' => $user->gender,
                    'user' => $user,
                    'newUsers' => $newUsers]);
    }

    /**
     * Deletes current user (session) from the users-table and logs out the
     * user.
     *
     * parameters:   void
     * returns:     redirect to logout 
     */
    public function destroy()
    {
        User::find(Auth::user()->id)->delete();
        return redirect('auth/logout');
    }

    /**
     * Asssistant function for pseudocalculation the completeness of a user
     * profile.
     *
     * parameters:   user-model instance
     * returns:     int user profile progress 
     */
    private function getUserProfileProgress($user) {

        // Users do not have a full profile by default. If country is NULL,
        // then most likely city and gender are NULL too (70 % progress for
        // info given at registration)
        if(is_null($user->country)) {
            $userProgress = 70;   
        }
        else {
            $userProgress =  100;
        }

        return $userProgress; 
    }
    
    /**
     * Asssistant function for checking if newest users should be searched
     * from the database (update information about new users every hour).
     *
     * parameters:   void
     * returns:     new users (cached or actual new users) 
     */
    function checkNewUsersCache() {
        
        if(Cache::has('newUsers')){
            $newUsers = Cache::get('newUsers');
        }
        else {
            $newUsers = User::where('id', '>', 0)->orderBy('created_at', 'desc')
                                    ->take(5)
                                    ->get();
            Cache::put('newUsers', $newUsers, 60);
        }
        
        return $newUsers;
    }
}
