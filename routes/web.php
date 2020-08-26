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

$router->get(
    '/version', function () use ($router) {
        return $router->app->version();
    }
);
$router->get(
    '/apis/catagory', 'CatagoriesController@get'
);
$router->get(
    '/apis/serviceman', 'ServicemanController@get'
);
$router->get(
    '/apis/slider', 'SliderController@get'
);
$router->get(
    '/apis/search', 'SearchController@search'
);
