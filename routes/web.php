<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@index');
Route::get('/home/{id}/edit','HomeController@edit'); // registrar
Route::post('/home/{id}/edit','HomeController@update')->name('update'); // registrar
Route::delete('/home/{id}','HomeController@destroy'); // eliminar
Route::post('/home/buscar', 'HomeController@search')->name('search'); //busqueda
Route::get('/home/buscar', 'HomeController@search')->name('search1'); //busqueda
Route::get('/home/form-email', 'HomeController@formShowEmail');
Route::post('/home/form-email', 'HomeController@formStoredEmail');
Route::get('/home/list-email', 'HomeController@emailList');

// Endpoint
Route::get('listado-email', 'EmailListController@listaCorreos');
