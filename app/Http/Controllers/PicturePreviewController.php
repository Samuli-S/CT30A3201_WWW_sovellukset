<?php
/**
 * Controller class for a page that shows pictures by category. 
 * 
 * This controller is in a extremely simple form because AJAX (AJAJ) -requests
 * are performed trough the picture modification / lookup main channels
 * (PictureDetailsController and PictureController).
 * 
 * This implementation is based on Laravel provided documentation and
 * the use of artisan command line interface (generate basic controller
 * structure).
 */
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PicturePreviewController extends Controller {
    /*
     * Users must have authorization in order to look at pictures.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display the page for viewing pictures by category. activePageLink
     * signifies header row active links (Home or Pictures)
     *
     * parameters:   none
     * returns:     view for looking at pictures by category
     */
    public function show()
    {
        return view('picture-preview', ['activePageLink' => 'pictures']);
    }
}
