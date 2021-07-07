<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
return response()->json(['greeting' => "Hello world in JSON",
 'developer'=> [
    'name' => "Gaiya M. Obed",
    'email' => "info@gaiyaobed.com.ng",
    'website' => "https://www.gaiyaobed.com.ng/",
    'github' => "https://github.com/gaiyadev",
    'location' => "Kaduna State",
    'stack' => "MERN, MEVN, MAVN, MARN, LAMP",
    'technologies' =>
        "HTML, CSS, JavaScript, VueJs, NuxtJs, ReactJs, NextJs, PWA, Bulma, Bootstrap, Vuetify, Laravel, Lumen, AdonisJs, ExpressJs, KoaJs, MYSQL, MongoDb, PHP, TypeScript, Flutter, Dart, Restful API, GraphQL API",
    'infrastructures' => "Netlify, Vercel, Heroku, Digital Ocean",
    'tools' => "npm, yarn",
],
'UI/UX'=>[
    'name' => "",
    'email' => "",
    'website' => "",
    'github' => "",
    'location' => "Kaduna State",
],
    'apidocs'=> "",
    'version' => "1.0.0",
    'lumen'=> $router->app->version()
], 
    200);
});


$router->group(['prefix' => 'api/v1/users'], function () use ($router) {
    $router->post("/signup", 'UserController@store');
    $router->post("/signin", 'UserController@login');
    $router->delete("/{id}", 'UserController@destroy');
    $router->get("/user", 'ProfileController@currentLogin');
    $router->put("/changePassword", 'ProfileController@changePassword');
    $router->put("/updateDetails", 'ProfileController@updateDetails');
    $router->get("/", 'UserController@index');
    // Car
    $router->post("/car", 'CarController@store');
    $router->get("/car", 'CarController@index');
    $router->get("/car/{id}", 'CarController@show');
    $router->put("/car/{id}", 'CarController@update');
    $router->delete("/car/{id}", 'CarController@destroy');
    $router->get("/car/one", 'CarController@symptoms');
  //  $router->get("/car/search/{search}", 'CarController@showSymptoms');
});
