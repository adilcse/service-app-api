<?php
/**
 * Handel Search related requests
 * 
 * PHP version: 7.0
 * 
 * @category Controller
 * @package  Http/Controllers
 * @author   Adil Hussain <adil.cs.work@gmail.com>
 * @license  https://opensource.org/licenses/PHP-3.0 statdard
 * @link     https://github.com/adilcse/service-app-api/blob/master/app/Http/Controllers/SearchController.php
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modal\Serviceman;
use App\Modal\Catagory;
use App\Helper\CheckData;
/**
 * Search related functions
 * 
 * @category Controller
 * @package  Http/Controllers
 * @author   Adil Hussain <adil.cs.work@gmail.com>
 * @license  https://opensource.org/licenses/PHP-3.0 statdard
 * @link     https://github.com/adilcse/service-app-api/blob/master/app/Http/Controllers/SearchController.php
 */
class SearchController extends Controller
{
    /**
     * Search request as query
     * Search in database for specified serach query and resturn with found result
     *
     * @param Request $request http request
     * 
     * @return response results
     */
    public function search(Request $request)
    {
        if ($request->q) {
            $keyword=$request->q;
            $data= Serviceman::select('*')->where('name', 'like', '%'.$keyword.'%')
                ->where('status', 1)
                ->limit(10)
                ->get();
            return CheckData::check($data, true);
        } else {
            return CheckData::check(null);
        }
    }
}
