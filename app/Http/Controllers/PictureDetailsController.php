<?php
/**
 * Controller class for a page that shows individual pictures. 
 * 
 * Uses multiple eloquent models (User, Picture, Comment and PictureVotes). 
 * To facilitate transfer of picture details, storing of comments (pictures can 
 * be commented) and storing of picture likes/dislikes (votes).
 * 
 * This implementation is based on Laravel provided documentation and
 * the use of artisan command line interface (generate basic controller
 * structure).
 */
 
namespace App\Http\Controllers;

// Uses multiple eloquent models.
use App\Picture;
use App\User;
use App\Comment;
use App\PictureVotes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PictureDetailsController extends Controller {
    
    /**
     * Show picture detail page for a picture with a specific ID.
     *
     * parameter:   http-request
     * parameter:   picture ID (corresponds to database primary key)
     * returns:     a new view with picture specific information or a error
     *              condidition (database findOrFail)
     */
    public function showPictureDetails(Request $request, $id) {

       /* 
        * It can be assumed that a picture will be viewed: increment view
        * counter
        */
        $picture = Picture::findOrFail($id);
        $picture->views = $picture->views + 1;
        $picture->save();

        $pictureOwner = User::find($picture->user_id);
        if(!$pictureOwner) {
            /* 
             * Set emtpy string to avoid odd values at transmitted pages.
             * This check if performed because users can delete themselfs -->
             * possible owner of a picture is not available.
             */
            $pictureOwnerUsername = '';
        }
        else {
            // Username is reachable.
            $pictureOwnerUsername = $pictureOwner->username;
        }

        // Get all comments for the given picture. Sort from newest to oldest.
        $comments = Comment::where('picture_id', $id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        // Tie extra userinformation to comments from the users-table.
        foreach($comments as $comment) {
            $user = User::find($comment->user_id);

            $comment->username = $user->username;
            // User profile pictures can be presented with comments.
            $comment->profilePicturePath = $user->profile_picture_path;
        }

        /*
         * Check if the user is eligible for voting (like/dislike) on picture.
         * Users can only vote onse per single picture.
         */
        $pictureVotes = PictureVotes::where('user_id', Auth::user()->id)
                                    ->where('picture_id', $id)
                                    ->get();

        if($pictureVotes->count() > 0) {
            // Found existing votes for this picture and current user.
            $allowedToVotePicture = false;
        }
        else {
            // User has not yet voted on this picture.
            $allowedToVotePicture = true;
        }

        // Return abundant information all relating to a single picture.
        return view('picture-details', 
                    ['activePageLink' => '', 
                    'picture' => $picture,
                    'pictureOwnerUsername' => $pictureOwnerUsername,
                    'comments' => $comments,
                    'allowedToVotePicture' => $allowedToVotePicture]);       
    }

    /**
     * Save new comment into storage (after validation). Return user details 
     * about the commentor so that comments can be placed without realoading the
     * page (comments have user profile pictures, usernames and timestamps).
     *
     * parameter:   http-request
     * returns:     transmitted comment with appended information (json-format)
     */
    public function savePictureComment(Request $request) {
        $this->validate($request, [
            'picture_id' => 'required|integer|exists:pictures,id',
            'comment' => 'required|min:2|max:255',
        ]);

        /*
         * Create a new comment by following general eloquent model principles.
         * Strip html-tags where possible.
         */
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->picture_id = $request->picture_id;
        $comment->comment = strip_tags($request->comment);
        $comment->likes = 0;
        $comment->dislikes = 0;
        $comment->save();

        $user = User::find(Auth::user()->id);
        $userProfilePicturePath = $user->profile_picture_path;
        if(is_null($userProfilePicturePath)) {
            // User has not set his or her profile picture.
            $userProfilePicturePath = '';
        }
        $comment->profile_picture_path = $userProfilePicturePath;
        
        $comment->username = $user->username;

        return response()->json($comment);
    }

    /**
     * Implements picture like and dislike (voting). Ensures that user is
     * allowed to vote by checking database records.
     *
     * parameter:   http-request
     * returns:     vote success in json-format (also possible return trough
     *              validation error)
     */
    public function votePicture(Request $request) {
        // May cause early return with error condition in json-format.
        $this->validate($request, [
            'picture_id' => 'required|integer|exists:pictures,id',
            'operation' => 'required|min:4|max:7',
        ]);

        $pictureVotes = PictureVotes::where('user_id', Auth::user()->id)
                                    ->where('picture_id', $request->picture_id)
                                    ->get();

        if($pictureVotes->count() > 0) {
            // User has voted on this picture before.
            $isSuccessful = false;
        }
        else {
            // A fresh vote.
            $picture = Picture::findOrFail($request->picture_id);
            $isSuccessful = true;
            if($request->operation == 'like') {
                $picture->likes = $picture->likes + 1;
            }
            else {
                $picture->dislikes = $picture->dislikes + 1; 
            }

            $picture->save();  // Database insert into pictures-table.

            // Store new picture vote into database.
            $pictureVotes = new PictureVotes;
            $pictureVotes->user_id = Auth::user()->id;
            $pictureVotes->picture_id = $request->picture_id;
            $pictureVotes->voted = true; // Not needed
            $pictureVotes->vote_type = $request->operation;
            $pictureVotes->save();  // Database insert into picture_votes-table.
        }

        return response()->json(['is_successful' => $isSuccessful]);
    }
}
