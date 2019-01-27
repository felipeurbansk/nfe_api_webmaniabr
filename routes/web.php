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

/** Grupo de rotas para Nota Fiscal Eletrônica */
Route::group(['prefix' => '/nfe'], function () {
    Route::get('/emitir_nfe', ['as' => 'nfe.emitir', 'uses' => 'NfeController@emitir']);
    Route::post('/salvar_nfe', ['as' => 'nfe.salvar', 'uses'=>'NfeController@salvar_nfe']);
    Route::get('/consulta', ['as'=> 'nfe.consulta', 'uses'=>'NfeController@consulta']);
    Route::get('/consultar_nfe', ['as' => 'nfe.consultar', 'uses'=>'NfeController@consultar_nfe']);
    Route::get('/cancelamento_nfe', ['as' => 'nfe.cancelamento', 'uses' => 'NfeController@cancelamento_nfe']);
    Route::put('/cancelar_nfe', ['as' => 'nfe.cancelar', 'uses' => 'NfeController@cancelar_nfe']);
    Route::get('/devolver_nfe', ['as' => 'nfe.devolver', 'uses' => 'NfeController@devolver_nfe']);
    Route::post('/devolucao_nfe', ['as' => 'nfe.devolucao', 'uses' => 'NfeController@devolucao_nfe']);
    Route::get('/validacao_cert', ['as' => 'nfe.validacao.cert', 'uses' => 'NfeController@validacao_cert']);
    Route::get('/validar_cert', ['as' => 'nfe.validar.cert', 'uses' => 'NfeController@validar_cert']);
    Route::get('/status_sefaz', ['as' => 'nfe.status.sefaz', 'uses' => 'NfeController@status_sefaz']);
});

/** Grupo de rotas para CEP */
Route::group(['prefix' => '/cep'], function () {
    Route::get('/', ['as' => 'cep', 'uses' => 'CepController@cep']);
    Route::get('/consultar_cep', ['as'=>'cep.consultar', 'uses' => 'CepController@consultar_cep']); 
});