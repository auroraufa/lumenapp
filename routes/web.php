<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\KategoriController;

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

$router->get('/', function () use ($router) {
    return ["Hello Guys!!!"];
});

$router->get('/users', function () use ($router) {
    $results = app('db')->select("SELECT * FROM users");
    return response()->json($results);
});
$router->get('/event', function () use ($router) {
    $results = app('db')->select("SELECT * FROM events");
    return response()->json($results);
});


$router->post('/register', 'UserController@register');
$router->post('/login', 'AuthController@login');
$router->get('/api/favorite/{id}', 'EventController@favorite');
$router->get('/api/myevent/{user_id}/{jenis}', 'EventController@myevent');


$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/api/users', function () use ($router) {
        $results = app('db')->select("SELECT * FROM users");
        return response()->json($results);
    });
    $router->get('/api/seminar/{jenis}', 'EventController@show');
    $router->post('/logout', 'AuthController@logout');
    $router->get('/api/kategori', 'KategoriController@getkategori');
    $router->post('/api/addKategori', 'UserController@addKategori');
    $router->get('api/showName/{id}', 'UserController@showName');
});
