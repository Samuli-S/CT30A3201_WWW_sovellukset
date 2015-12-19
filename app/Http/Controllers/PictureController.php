<?php
/**
 * Controller class for picture storing and lookup. 
 * 
 * Uses the Picture-model (Laravel eloquent ORM-model) to store pictures into
 * database and to search them by category.
 * 
 * This implementation is based on Laravel provided documentation and
 * the use of artisan command line interface (generate basic controller
 * structure).
 */
namespace App\Http\Controllers;

use App\Picture;  // Laravel eloquent model for database handling.
use Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Save and lookup require authorization.

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PictureController extends Controller {
    
    /**
     * Constructor sets the auth-middleware -> no unauthorized access (login 
     * needede).
     * 
     * parameters:  void
     * returns:     void
     */
    public function __construct() {
        $this->middleware('auth');
    }

     /**
     * Saves a single validated picture (actually information about the
     * picture) into storage (database).
     *
     * parameter:   http-request $request
     * returns:     void (indirect return if validation fails)
     */
    public function save(Request $request) {
       
        /*
         * Validates request and initiates json-response if given picture
         * properties are invalid.
         */
        $this->validate($request, [
            'header' => 'required|min:3|max:50',
            'description' => 'max:255',
            'category' => 'required|max:50',
            'file' => 'required|mimes:jpeg,png,image/jpeg,image/png|max:3000'
        ]);
        
        $file = $request->file('file');
        // Generates unique filename based on current time.
        $filename = uniqid() . strip_tags($file->getClientOriginalName());

        // File reside in the pictures-folder (app/public/pictures).
        $file->move('pictures', $filename);
        
        /*
         * Create new picture (model) instance, set its variables and store it
         * into database (use of Laravel eloquent model). Strips html-tags
         * before database insert.
         */
        $picture = new Picture;
        $picture->user_id = Auth::user()->id;  // Current user has a session.
        $picture->header = strip_tags($request->header);
        if(!empty($request->description)) {
            // File description can be left empty.
            $picture->description = strip_tags($request->description);
        }
        $picture->category = strip_tags($request->category);
        $picture->views = 0;
        $picture->likes = 0;
        $picture->dislikes = 0;
        $picture->flagged = false;
        $picture->filename = $filename;
        $picture->path = 'pictures/' . $filename;
        $picture->size = $file->getClientSize();
        $picture->mime_type = strip_tags($file->getClientMimeType());

        $picture->save();  // Insert into database (pictures-table).
    }

    /**
     * Find pictures by category and send them back in json-format.
     *
     * parameter:   http-request $request
     * returns:     json-response
     */
    public function findByCategory(Request $request) {
    
        // Pictures are ordered from most liked to least liked by default.
        $pictures = Picture::where('category', $request->category)
                            ->orderBy('likes', 'desc')
                            ->get();
                            
        return response()->json($pictures);
    }
}
