<?php
/**
 * Handel catagory related requests
 * 
 * PHP version: 7.0
 * 
 * @category Controller
 * @package  Http/Controllers
 * @author   Adil Hussain <adil.cs.work@gmail.com>
 * @license  https://opensource.org/licenses/PHP-3.0 statdard
 * @link     https://github.com/adilcse/service-app-api/blob/master/app/Http/Controllers/CatagoriesController.php
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modal\Catagory;
use App\Helper\CheckData;
/**
 * Check Catagories
 * 
 * @category ExtraClass
 * @package  Helper
 * @author   Adil Hussain <adil.cs.work@gmail.com>
 * @license  https://opensource.org/licenses/PHP-3.0 statdard
 * @link     https://github.com/adilcse/service-app-api/blob/master/app/Http/Controllers/CatagoriesController.php
 */
class CatagoriesController extends Controller
{
    /**
     * Handle get catagories request
     *
     * @param Request $request http request
     *
     * @return void
     */
    public function get(Request $request)
    {
        if ($request->view=='all') {
            $cats= Catagory::all();
            return CheckData::check($cats, true);
        } elseif ($request->id) {
            $cat = Catagory::find($request->id);
            return CheckData::check($cat);
        } else {
            return CheckData::check($cat);
        }
    }
}

