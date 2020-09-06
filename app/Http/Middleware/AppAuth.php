<?php
/**
 * Middleware for authorization
 * 
 * PHP version: 7.0
 * 
 * @category Middleware
 * @package  Http/Middleware
 * @author   Adil Hussain <adil.cs.work@gmail.com>
 * @license  https://opensource.org/licenses/PHP-3.0 statdard
 * @link     https://github.com/adilcse/service-app-api/blob/master/app/Http/Middleware/AppAuth.php
 */
namespace App\Http\Middleware;
use \Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\DB;

/**
 * Middleware for authorization
 * 
 * @category Controller
 * @package  Http/Controllers
 * @author   Adil Hussain <adil.cs.work@gmail.com>
 * @license  https://opensource.org/licenses/PHP-3.0 statdard
 * @link     https://github.com/adilcse/service-app-api/blob/master/app/Http/Middleware/AppAuth.php
 */
class AppAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request request
     * @param \Closure                 $next    next
     * @param mixed                    $guard   guard
     * 
     * @return mixed
     */
    public function handle($request, Closure $next,$guard=null)
    {
        //check for valid authorization header
        if ($request->header('Authorization')) {
            if ($request->header('Authorization')===$_ENV['APP_API_KEY']) {
                return $next($request);
            } else {
                return \response(['message'=>'authorization failed'], 401);
            }
        }
        return \response(['message'=>'key not provided'], 401);
    }
}
