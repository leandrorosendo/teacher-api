<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Models\Discipline;
use App\Models\Teacher;
use App\Models\TeacherDiscipline;

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
    return $router->app->version();
});





$router->group(['prefix' => 'api'], function () use ($router) {
    
    $router->get('teachers',  ['uses' => 'TeacherController@show']);
    $router->post('teachers', ['uses' => 'TeacherController@store']);
    $router->delete('teachers/{id}', ['uses' => 'TeacherController@destroy']);
    $router->put('teachers/{id}', ['uses' => 'TeacherController@update']);


    $router->get('teachers/disciplines',  ['uses' => 'TeacherDisciplineController@show']);
    $router->post('teachers/disciplines', ['uses' => 'TeacherDisciplineController@store']);
    $router->delete('teachers/disciplines/{id}', ['uses' => 'TeacherDisciplineController@destroy']);
    $router->put('teachers/disciplines/{id}', ['uses' => 'TeacherDisciplineController@update']);
    
    $router->get('disciplines',  ['uses' => 'DisciplineController@show']);
    $router->post('disciplines', ['uses' => 'DisciplineController@store']);
    $router->delete('disciplines/{id}', ['uses' => 'DisciplineController@destroy']);
    $router->put('disciplines/{id}', ['uses' => 'DisciplineController@update']);
    
  });