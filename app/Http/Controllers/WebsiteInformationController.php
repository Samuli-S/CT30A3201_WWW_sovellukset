<?php
/**
 * Controller class for informative web application pages: About, Contact and
 * Legal -categories. 
 * 
 * Shows (returns) the view for web application information.
 * 
 * This implementation is based on Laravel provided documentation and
 * the use of artisan command line interface (generate basic controller
 * structure).
 */
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WebsiteInformationController extends Controller {

    /**
     * Display the specified resource.
     *
     * parameter:   target resource (identifier for the open page portion)
     * returns:     view for web application information opened from the
     *              requested portion (About, Contact and Legal portitions)
     */
    public function show($target)
    {
        return view('website-information', 
                    ['activePageLink' => '', 'activeTab' => $target]);
    }
}
