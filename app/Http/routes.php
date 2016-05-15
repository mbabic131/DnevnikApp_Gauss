<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'CrudController@index');
Route::get('/archives', 'CrudController@show');
Route::get('/edit/{id}', 'CrudController@edit');
Route::get('/details/{id}', 'CrudController@details');

Route::post('store', 'CrudController@store');
Route::patch('update/{id}', 'CrudController@update');
Route::get('delete/{id}', 'CrudController@delete');
