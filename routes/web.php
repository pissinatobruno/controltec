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
    return view('index');
});

Auth::routes();

Route::get('/clientes', 'ControladorCliente@index')->name('clientes');
//Route::get('/enderecos', 'ControladorEndereco@index')->name('enderecos');
//Route::get('/telefones', 'ControladorTelefone@index')->name('telefones');
//Route::get('/pf', 'ControladorPessoaFisica@index')->name('pf');
//Route::get('/pj', 'ControladorPessoaJuridica@index')->name('pj');
Route::get('/ordensservico', 'ControladorOrdensServico@index')->name('ordensservico');
Route::get('/numeroconta', 'ControladorNumeroConta@index')->name('numeroconta');
Route::get('/status', 'ControladorStatus@index')->name('status');
Route::get('/servicos', 'ControladorServico@index')->name('servicos');
Route::get('/metas', 'ControladorMeta@index')->name('metas');
Route::get('/agendamentos', 'ControladorAgendamento@index')->name('agendamentos');
Route::get('/cargos', 'ControladorCargo@index')->name('cargos');
Route::get('/funcionarios', 'ControladorFuncionario@index')->name('funcionarios');
Route::get('/equipamentos', 'ControladorEquipamento@index')->name('equipamentos');


Route::get('/novocliente', 'ControladorCliente@create')->name('novocliente');
Route::get('/novostatus', 'ControladorStatus@create')->name('novostatus');
Route::get('/novocargo', 'ControladorCargo@create')->name('novocargo');
Route::get('/novoequipamento', 'ControladorEquipamento@create')->name('novoequipamento');
Route::get('/novaordem', 'ControladorOrdensServico@create')->name('novaordem');
Route::get('/novaordem', 'ControladorOrdensServico@create')->name('novaordem');
Route::get('/novaordem', 'ControladorOrdensServico@create')->name('novaordem');
Route::get('/novaordem', 'ControladorOrdensServico@create')->name('novaordem');








