<?php

namespace App\Http\Middleware;
use \Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\DB;

class AppAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard=null)
    {


        if ($request->header('Authorization')) {
            $key=DB::table('app_api')->select('api_key')->where('name', 'app_id')->first();
            if ($request->header('Authorization')===$key->api_key) {
                return $next($request);
            } else {
                return \response(['message'=>'authorization failed'], 401);
            }
        }
        return \response(['message'=>'key not provided'], 401);

        //  return $next($request);
    }
}
