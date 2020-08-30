<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->group(
    ['prefix' => 'apis','middleware'=>'auth'], function () use ($router) {
        $router->get(
            '/catagory', 'CatagoriesController@get'
        );
        $router->get(
            '/serviceman', 'ServicemanController@get'
        );
        $router->get(
            '/serviceman/status', 'ServicemanController@status'
        );
        $router->post(
            '/serviceman', 'ServicemanController@add'
        );
        $router->get(
            '/slider', 'SliderController@get'
        );
        $router->get(
            '/search', 'SearchController@search'
        );
        $router->get(
            '/{*}', function () use ($router) {
                return  response(["message"=>'invalid url'], 404);
            }
        );
    
    }
);
$router->get(
    '/version', function () use ($router) {
        return $router->app->version();
    }
);
$router->get(
    '/{*}', function () use ($router) {
        return  response(["message"=>'invalid url'], 404);
    }
);