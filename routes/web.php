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

Route::get('/', 'NfeController@index');
Route::get('/emitirnfe', 'NfeController@emitir');
Route::post('/salvarnfe', 'NfeController@salvar');
Route::get('/consultar', 'NfeController@consultar');
Route::get('/consultar_nfe', 'NfeController@consultar_nfe');
