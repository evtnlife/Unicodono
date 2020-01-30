<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
|--------------------------------------------------------------------------
| AUTH API Routes
|--------------------------------------------------------------------------
*/
Route::group([

    'middleware' => ['api'],
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout')->name('api-logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    //Revenda
    Route::post('revenda/create', 'RevendaController@create');
    Route::post('revenda/update', 'RevendaController@update');
    Route::post('revenda/destroy', 'RevendaController@destroy');
    Route::get('revenda', 'RevendaController@index');
    //Plano
    Route::post('plano/create', 'PlanoController@create');
    Route::post('plano/edit', 'PlanoController@edit');
});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::post('cadastro', 'Auth\RegisterController@create');
    Route::get('estados', 'EstadoController@index');
    Route::get('cidades/{uf}', 'EstadoController@getCidadesByEstadoID');
    Route::get('plano', 'PlanoController@index');
});