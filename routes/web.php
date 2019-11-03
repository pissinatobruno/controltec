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
Auth::routes();
Route::get('/users', 'ControladorUser@index')->name('users');
Route::get('/', 'ControladorDashboard@index');
Route::get('/clientes', 'ControladorCliente@index')->name('clientes');
Route::get('/ordensservico', 'ControladorOrdensServico@index')->name('ordensservico');
//Route::get('/numeroconta', 'ControladorNumeroConta@index')->name('numeroconta');
Route::get('/status', 'ControladorStatus@index')->name('status');
Route::get('/servicos', 'ControladorServico@index')->name('servicos');
Route::get('/metas', 'ControladorMeta@index')->name('metas');
Route::get('/agendamentos', 'ControladorAgendamento@index')->name('agendamentos');
Route::get('/cargos', 'ControladorCargo@index')->name('cargos');
Route::get('/funcionarios', 'ControladorFuncionario@index')->name('funcionarios');
Route::get('/equipamentos', 'ControladorEquipamento@index')->name('equipamentos');

Route::get('/clientesdata', 'ControladorCliente@datatable')->name('clientes.datatable');

Route::get('/novocliente', 'ControladorCliente@create')->name('novocliente');
Route::get('/novostatus', 'ControladorStatus@create')->name('novostatus');
Route::get('/novocargo', 'ControladorCargo@create')->name('novocargo');
Route::get('/novoequipamento', 'ControladorEquipamento@create')->name('novoequipamento');
Route::get('/novofuncionario', 'ControladorFuncionario@create')->name('novofuncionario');
Route::get('/novameta', 'ControladorMeta@create')->name('novameta');
Route::get('/novaordem', 'ControladorOrdensServico@create')->name('novaordem');
Route::get('/novoservico', 'ControladorServico@create')->name('novoservico');
Route::get('/novoagendamento', 'ControladorAgendamento@create')->name('novoagendamento');

Route::post('novocliente', 'ControladorCliente@store')->name('clientes.store');








Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
