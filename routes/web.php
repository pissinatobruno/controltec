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

Route::group(['middleware' => ['auth']], function () {


        Route::get('/', 'ControladorDashboard@index');

        Route::get('/clientes', 'ControladorCliente@index')->name('clientes');
        Route::get('/status', 'ControladorStatus@index')->name('status');
        Route::get('/servicos', 'ControladorServico@index')->name('servicos');
        Route::get('/metas', 'ControladorMeta@index')->name('metas');
        Route::get('/agendamentos', 'ControladorAgendamento@index')->name('agendamentos');
        Route::get('/equipamentos', 'ControladorEquipamento@index')->name('equipamentos');
        Route::get('/tecnicos', 'ControladorTecnico@index')->name('tecnicos');
        Route::get('/auxiliares', 'ControladorAuxiliar@index')->name('auxiliares');
        Route::get('/ordens', 'ControladorOrdensServico@index')->name('ordens');
        

        Route::get('/clientesdata', 'ControladorCliente@datatable')->name('clientes.datatable');
        Route::get('/statusdata', 'ControladorStatus@datatable')->name('status.datatable');
        Route::get('/equipamentosdata', 'ControladorEquipamento@datatable')->name('equipamentos.datatable');
        Route::get('/auxiliardata', 'ControladorAuxiliar@datatable')->name('auxiliar.datatable');
        Route::get('/tecnicodata', 'ControladorTecnico@datatable')->name('tecnicos.datatable');
        Route::get('/servicodata', 'ControladorServico@datatable')->name('servico.datatable');
        Route::get('/osdata', 'ControladorOrdensServico@datatable')->name('ordens.datatable');

        Route::get('/clientescpf/{cpf}', 'ControladorCliente@show')->name('clientes.show');

        Route::group(['middleware' => ['role:Administrador|Utilizador']], function () {
                
                Route::get('/editarclientes/{id}', 'ControladorCliente@edit')->name('editcliente');
                Route::get('/editarordem/{id}', 'ControladorOrdensServico@edit')->name('editordem');

                Route::get('/novaordem', 'ControladorOrdensServico@create')->name('novaordem');
                Route::get('/novocliente', 'ControladorCliente@create')->name('novocliente');

                Route::post('novocliente', 'ControladorCliente@store')->name('clientes.store');
                Route::put('/upcliente/{id}', 'ControladorCliente@update')->name('clientes.update');
                Route::delete('/delcliente/{id}', 'ControladorCliente@destroy')->name('clientes.delete');

                Route::post('novaordem', 'ControladorOrdensServico@store')->name('ordens.store');
                Route::put('/upordem/{id}', 'ControladorOrdensServico@update')->name('ordens.update');
                Route::delete('/delordem/{id}', 'ControladorOrdensServico@destroy')->name('ordens.delete');

                Route::post('novoagendamento', 'ControladorAgendamento@store')->name('agendamento.store');
                Route::get('agendamento/{id}', 'ControladorAgendamento@edit')->name('agendamento.edit');
        });

        Route::group(['middleware' => ['role:Administrador']], function () {

                Route::get('/users', 'ControladorUser@index')->name('users');
                Route::get('/userdata', 'ControladorUser@datatable')->name('user.datatable');

                Route::get('/novostatus', 'ControladorStatus@create')->name('novostatus');
                Route::get('/novoequipamento', 'ControladorEquipamento@create')->name('novoequipamento');
                Route::get('/novameta', 'ControladorMeta@create')->name('novameta');
                Route::get('/novoservico', 'ControladorServico@create')->name('novoservico');
                Route::get('/novotecnico', 'ControladorTecnico@create')->name('novotecnico');
                Route::get('/novoauxiliar', 'ControladorAuxiliar@create')->name('novoauxiliar');
                Route::get('/novouser', 'ControladorUser@create')->name('novouser');


                Route::get('/editarstatus/{id}', 'ControladorStatus@edit')->name('editstatus');
                Route::get('/editarequipamento/{id}', 'ControladorEquipamento@edit')->name('editequipamento');
                Route::get('/editarmeta/{id}', 'ControladorMeta@edit')->name('editmeta');
                Route::get('/editarservico/{id}', 'ControladorServico@edit')->name('editservico');
                Route::get('/editartecnico/{id}', 'ControladorTecnico@edit')->name('edittecnico');
                Route::get('/editarauxiliar/{id}', 'ControladorAuxiliar@edit')->name('editauxiliar');
                Route::get('/editaruser/{id}', 'ControladorUser@edit')->name('edituser');

                Route::post('novostatus', 'ControladorStatus@store')->name('status.store');

                Route::post('novoequipamento', 'ControladorEquipamento@store')->name('equipamentos.store');
                Route::put('/upequipamento/{id}', 'ControladorEquipamento@update')->name('equipamentos.update');
                Route::delete('/delequipamento/{id}', 'ControladorEquipamento@destroy')->name('equipamentos.delete');

                Route::post('novoauxiliar', 'ControladorAuxiliar@store')->name('auxiliar.store');
                Route::put('/upauxiliar/{id}', 'ControladorAuxiliar@update')->name('auxiliar.update');
                Route::delete('/delauxiliar/{id}', 'ControladorAuxiliar@destroy')->name('auxiliar.delete');

                Route::post('novotecnico', 'ControladorTecnico@store')->name('tecnico.store');
                Route::put('/uptecnico/{id}', 'ControladorTecnico@update')->name('tecnico.update');
                Route::delete('/deltecnico/{id}', 'ControladorTecnico@destroy')->name('tecnico.delete');

                Route::post('novoservico', 'ControladorServico@store')->name('servico.store');
                Route::put('/upservico/{id}', 'ControladorServico@update')->name('servico.update');
                Route::delete('/delservico/{id}', 'ControladorServico@destroy')->name('servico.delete');

                Route::post('novouser', 'ControladorUser@store')->name('user.store');
                Route::put('/upuser/{id}', 'ControladorUser@update')->name('user.update');
                Route::delete('/deluser/{id}', 'ControladorUser@destroy')->name('user.delete');

                Route::get('/relatorios/clientes', 'ControladorCliente@relatorio')->name('relatorio.clientes');
                Route::get('/relatorios/rotas', 'ControladorCliente@relatorio')->name('relatorio.rotas');
                Route::get('/relatorios/ordens', 'ControladorOrdensServico@relatorio')->name('relatorio.ordens');

                Route::get('/relatorios/pesclientes', 'ControladorCliente@pesquisa')->name('pesquisa.clientes');
                Route::get('/relatorios/pesos', 'ControladorOrdensServico@pesquisa')->name('pesquisa.os');
        });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
