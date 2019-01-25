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

/** Rotas de Nota Fiscal Eletrônica */
Route::get('/', 'NfeController@index');
Route::get('/nfe/emitirnfe', 'NfeController@emitir');
Route::post('/nfe/salvarnfe', 'NfeController@salvar');
Route::get('/nfe/consultar', 'NfeController@consultar');
Route::get('/nfe/consultar_nfe', 'NfeController@consultar_nfe');

/** Rotas de CEP */
Route::get('/cep/consultar', 'CepController@cep');