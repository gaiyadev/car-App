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
    'stack'=> "MERN, MEVN, MAVN, MARN, LAMP",
    'technologies'=>
        "HTML, CSS, JavaScript, VueJs, NuxtJs, ReactJs, NextJs, PWA, Bulma, Bootstrap, Vuetify, Laravel, Lumen, AdonisJs, ExpressJs, KoaJs, MYSQL, MongoDb, PHP, TypeScript, Flutter, Dart, Restful API, GraphQL API",
    'infrastructures'=> "Netlify, Vercel, Heroku, Digital Ocean",
    'tools' => "npm, yarn",
],
'U/UX'=>[
    'name' => "Gaiya M. Obed",
    'email' => "info@gaiyaobed.com.ng",
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


// $router->group(['prefix' => 'api/v1'], function () use ($router) {
//     $router->post("register", 'UserController@register');
//     $router->post("login", 'UserController@login');
//     $router->post("add", 'NewsController@store');
//     $router->get("{id}", 'NewsController@show');
//     $router->get("", 'NewsController@index');
//     $router->put("{id}", 'NewsController@update');
//     $router->delete("{id}", 'NewsController@destroy');
//     $router->get("user/{id}", 'ProfileController@index');
//    // $router->get("auth", 'ProfileController@userNews');
// });
