<?php
/**
 * Handel Slider request
 * 
 * PHP version: 7.0
 * 
 * @category Controller
 * @package  Http/Controllers
 * @author   Adil Hussain <adil.cs.work@gmail.com>
 * @license  https://opensource.org/licenses/PHP-3.0 statdard
 * @link     https://github.com/adilcse/service-app-api/blob/master/app/Http/Controllers/SliderController.php
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modal\Slider;
use App\Helper\CheckData;
/**
 * Get slider request
 * 
 * @category Controller
 * @package  Http/Controllers
 * @author   Adil Hussain <adil.cs.work@gmail.com>
 * @license  https://opensource.org/licenses/PHP-3.0 statdard
 * @link     https://github.com/adilcse/service-app-api/blob/master/app/Http/Controllers/SliderController.php
 */
class SliderController extends Controller
{
    /**
     * Get slider request
     *
     * @param Request $request http request
     * 
     * @return void
     */
    public function get(Request $request)
    {
        if ($request->view=='all') {
            $cats= Slider::limit(5)->get();
            return CheckData::check($cats, true);
        } else if ($request->id) {
            $cat = Slider::find($request->id);
            return CheckData::check($cat, false);
        } else {
            return  CheckData::check(null);
        }
    }
}
