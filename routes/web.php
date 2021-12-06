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
    return $router->app->version();
});
//Muestra id, nombre, imagen, video del club y nombre completo del instructor
//$router->get('/join', 'InstructorController@union');
//Muestra la información solo de los clubes deportivos


//$router->group(['middleware'=>['cors']], function() use($router){
    $router->get('/login/{id}/{password}', 'AuthController@login');

    $router->get('/clubes', 'ClubController@index');

    $router->get('/deportivo', 'ClubController@deportivo');
    //Muestra la información solo de los clubes academicos
    $router->get('/academico', 'ClubController@academico');
    //Muestra la información solo de los clubes culturales
    $router->get('/cultural', 'ClubController@cultural');
    //Muestra solo el nombre del club
    $router->get('/nombreClub', 'ClubController@nombreClub');

    $router->get('/clubIns/{id}', 'InstructorController@club');
    
    $router->get('/clubes/{id}', 'ClubController@get');
    
    $router->get('/folio/{folio}', 'AlumnoController@alumnoFolio');
    
    $router->post('/alumnos', 'AlumnoController@create');
    
    
    //});
    
    $router->group(['middleware'=>['auth']], function() use($router){
    $router->get('/alumnos', 'AlumnoController@index');
    $router->get('/alumnos/{id}', 'AlumnoController@get');
    $router->put('/alumnos/{id}', 'AlumnoController@update');
    $router->delete('/alumnos/{id}', 'AlumnoController@destroy');
    $router->get('/alumnosClub/{id}', 'AlumnoController@alumnosClub');
    
    $router->get('/instructores', 'InstructorController@index');
    $router->get('/instructores/{id}', 'InstructorController@get');
    $router->post('/instructores', 'InstructorController@create');
    $router->put('/instructores/{id}', 'InstructorController@update');
    $router->delete('/instructores/{id}', 'InstructorController@destroy');

    $router->post('/clubes', 'ClubController@create');
    $router->post('/clubes/{id}', 'ClubController@update');
    $router->delete('/clubes/{id}', 'ClubController@destroy');

}
);
    