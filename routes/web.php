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

//Auth
Auth::routes();

Route::post('usuarios', 'UsuariosController@store')->name('usuarios.store');
Route::get('usuarios/create', 'UsuariosController@create')->name('usuarios.create');


//OBRAS
//Home

Route::get('/home', 'HomeController@index')->name('home');

//Parâmetros
Route::get('/extintor', 'ExtintorController@index')->name("indexExtintor");
Route::get('/extintor/vincular-veiculo', 'ExtintorController@vincular')->name("vincularExtintor");
Route::get("/extintor/create", "ExtintorController@create")->name("createExtintor");
Route::get("/extintor/edit/{idExtintor}", "ExtintorController@edit")->name("editExtintor");
Route::post("/extintor/store", "ExtintorController@store")->name("storeExtintor");
Route::put("/extintor/update/{idExtintor}", "ExtintorController@update")->name("updateExtintor");
Route::get("/extintor/delete/{idExtintor}", "ExtintorController@delete")->name("deleteExtintor");
Route::get("/extintor/details/{idExtintor}", "ExtintorController@details")->name("detailsExtintor");

Route::get('/tipo-assunto', 'TipoAssuntoController@index')->name("indexTipoAssunto");
Route::get("/tipo-assunto/create", "TipoAssuntoController@create")->name("createTipoAssunto");
Route::get("/tipo-assunto/edit/{idTipoAssunto}", "TipoAssuntoController@edit")->name("editTipoAssunto");
Route::post("/tipo-assunto/store", "TipoAssuntoController@store")->name("storeTipoAssunto");
Route::put("/tipo-assunto/update/{idTipoAssunto}", "TipoAssuntoController@update")->name("updateTipoAssunto");

Route::get('/assunto', 'AssuntoController@index')->name("indexAssunto");
Route::get("/assunto/create", "AssuntoController@create")->name("createAssunto");
Route::get("/assunto/edit/{idAssunto}", "AssuntoController@edit")->name("editAssunto");
Route::post("/assunto/store", "AssuntoController@store")->name("storeAssunto");
Route::put("/assunto/update/{idAssunto}", "AssuntoController@update")->name("updateAssunto");

Route::get('/status', 'StatusController@index')->name("indexStatus");
Route::get("/status/create", "StatusController@create")->name("createStatus");
Route::get("/status/edit/{idStatus}", "StatusController@edit")->name("editStatus");
Route::post("/status/store", "StatusController@store")->name("storeStatus");
Route::put("/status/update/{idStatus}", "StatusController@update")->name("updateStatus");

Route::get('/estagiario', 'EstagiarioController@index')->name("indexEstagiario");
Route::get('/estagiario/create', 'EstagiarioController@create')->name('createEstagiario');
Route::get("/estagiario/edit/{idEstagiario}", 'EstagiarioController@edit')->name('editEstagiario');
Route::post("/estagiario/store", "EstagiarioController@store")->name("storeEstagiario");
Route::put("/estagiario/update/{idEstagiario}", "EstagiarioController@update")->name("updateEstagiario");

Route::get('/engenheiro', 'EngenheiroController@index')->name("indexEngenheiro");
Route::get('/engenheiro/create', 'EngenheiroController@create')->name('createEngenheiro');
Route::get("/engenheiro/edit/{idEngenheiro}", 'EngenheiroController@edit')->name('editEngenheiro');
Route::post("/engenheiro/store", "EngenheiroController@store")->name("storeEngenheiro");
Route::put("/engenheiro/update/{idEngenheiro}", "EngenheiroController@update")->name("updateEngenheiro");

Route::get('/protocolo', 'ProtocoloController@index')->name("indexProtocolo");
Route::get("/protocolo/create", "ProtocoloController@create")->name("createProtocolo");
Route::get("/protocolo/edit/{idProtocolo}", "ProtocoloController@edit")->name("editProtocolo");
Route::post("/protocolo/store", "ProtocoloController@store")->name("storeProtocolo");
Route::put("/protocolo/update/{idProtocolo}", "ProtocoloController@update")->name("updateProtocolo");

Route::get('/setor-protocolo', 'SetorProtocoloController@index')->name("indexSetorProtocolo");
Route::get("/setor-protocolo/create", "SetorProtocoloController@create")->name("createSetorProtocolo");
Route::get("/setor-protocolo/edit/{idSetor}", "SetorProtocoloController@edit")->name("editSetorProtocolo");
Route::post("/setor-protocolo/store", "SetorProtocoloController@store")->name("storeSetorProtocolo");
Route::put("/setor-protocolo/update/{idSetor}", "SetorProtocoloController@update")->name("updateSetorProtocolo");

//Route::get('getProtocolos', 'ProtocoloController@getProtocolos')->name('getProtocolos');

//Documentos
Route::get('/documentos/{idProtocolo}', "DocumentoController@index")->name('indexDocumentos');
Route::get('/listagem-documentos', "DocumentoController@listagem")->name('listagemDocumentos');
Route::get('/emitir-segunda-via/{id}', "DocumentoController@emitirSegundaVia")->name('emitirSegundaVia');
Route::post('/documentos/triagem/{idProtocolo}', "DocumentoController@triagem")->name('triagemDocumentos');

Route::post('/validate-document', "DocumentoController@validateDocument")->name('validateDocument');

Route::get('/relatorios', 'RelatorioController@index')->name("indexRelatorios");
Route::get('/relatorios/servicos-executados', 'RelatorioController@servicosExecutados')->name('servicosExecutados');
Route::get('/relatorios/todos-servicos', 'RelatorioController@todosServicos')->name('todosServicos');

Route::get('/relatorios-veiculos', 'RelatorioVeiculoController@index')->name('indexRelatorioVeiculo');
Route::get('/relatorios-veiculos/gerar', 'RelatorioVeiculoController@gerar')->name('gerarRelatorioVeiculo');

Route::get('/relatorios-autonomia', 'RelatorioAutonomiaController@index')->name('indexRelatorioAutonomia');
Route::get('/relatorios-autonomia/gerar', 'RelatorioAutonomiaController@gerar')->name('gerarRelatorioAutonomia');

Route::get('/numero-documento', 'NumeroDocumentoController@index')->name("indexNumeroDocumento");
Route::get('/numero-documento/create', 'NumeroDocumentoController@create')->name('createNumeroDocumento');
Route::put('/numero-documento/update', 'NumeroDocumentoController@update')->name('updateNumeroDocumento');

Route::get('/anexar-documento/{idProtocolo}', 'DocumentoAnexadoController@index')->name('indexAnexarDocumento');
Route::get('/anexar-documento/create/{idProtocolo}', 'DocumentoAnexadoController@create')->name('createAnexarDocumento');
Route::post('/anexar-documento/store/{idProtocolo}', 'DocumentoAnexadoController@store')->name('storeAnexarDocumento');
Route::get('/anexar-documento/{idProtocolo}/show/{caminho}', 'DocumentoAnexadoController@showPdf')->name('showAnexarDocumento');

Route::get('getVistoriaByProtocolo', 'ProtocoloController@getVistoriaByProtocolo')->name('getVistoriaByProtocolo');
Route::get('openVistoriaProtocolo/{id}', 'ProtocoloController@openVistoriaProtocolo')->name('openVistoriaProtocolo');


Route::get('/ged', 'GedController@index')->name('indexGed');
Route::get('/ged/create', 'GedController@create')->name('createGed');
Route::post('/ged/store', 'GedController@store')->name('storeGed');
Route::get('/ged/show/{id}', 'GedController@show')->name('showGed');
Route::get('/ged/edit/{id}', 'GedController@edit')->name('editGed');
Route::put('/ged/update/{id}', 'GedController@update')->name('updateGed');
Route::delete('/ged/delete/{id}', 'GedController@delete')->name('deleteGed');

Route::get('/possivel-observacao', 'PossivelObservacaoController@index')->name("indexPossivelObservacao");
Route::get("/possivel-observacao/create", "PossivelObservacaoController@create")->name("createPossivelObservacao");
Route::get("/possivel-observacao/edit/{id}", "PossivelObservacaoController@edit")->name("editPossivelObservacao");
Route::post("/possivel-observacao/store", "PossivelObservacaoController@store")->name("storePossivelObservacao");
Route::put("/possivel-observacao/update/{id}", "PossivelObservacaoController@update")->name("updatePossivelObservacao");

Route::get('getObservacoes', 'GedController@getObservacoes')->name('getObservacoes');
Route::get('getObservacoesPreenchidas', 'GedController@getObservacoesPreenchidas')->name('getObservacoesPreenchidas');

//JSON
Route::get('getQuadrasCasas', 'ProtocoloController@getQuadrasCasas')->name('getQuadrasCasas');
Route::get('getNumerosCasas', 'ProtocoloController@getNumerosCasas')->name('getNumerosCasas');

Route::get('getStatus', 'ProtocoloController@getStatus')->name('getStatus');
Route::post('insertStatusFromModal', 'ProtocoloController@insertStatusFromModal')->name('insertStatusFromModal');
Route::get('getResponsavel', 'ProtocoloController@getResponsavel')->name('getResponsavel');
Route::get('getSetQuadLot', 'ProtocoloController@getSetQuadLot')->name('getSetQuadLot');
Route::post('insertResponsavelFromModal', 'ProtocoloController@insertResponsavelFromModal')->name('insertResponsavelFromModal');

//Outras Funcionalidades
Route::get('/atualizar-status', 'AtualizarStatusController@index')->name("indexAtualizarStatus");
Route::get('/atualizar-status/edit/{idProtocolo}', 'AtualizarStatusController@edit')->name('editAtualizarStatus');
Route::put('/atualizar-status/update/{idProtocolo}', 'AtualizarStatusController@update')->name('updateAtualizarStatus');


/////////////////////////////////////////////////////ENTULHO/////////////////////////////////////////////////////
//Home
Route::get('/home-entulho', 'HomeEntulhoController@index')->name('homeEntulho');

//Parâmetros
Route::get('/empresa', 'EmpresaController@index')->name("indexEmpresa");
Route::get("/empresa/create", "EmpresaController@create")->name("createEmpresa");
Route::get("/empresa/edit/{idEmpresa}", "EmpresaController@edit")->name("editEmpresa");
Route::post("/empresa/store", "EmpresaController@store")->name("storeEmpresa");
Route::put("/empresa/update/{idEmpresa}", "EmpresaController@update")->name("updateEmpresa");

Route::get('/veiculo', 'VeiculoController@index')->name("indexVeiculo");
Route::get("/veiculo/create", "VeiculoController@create")->name("createVeiculo");
Route::get("/veiculo/edit/{idVeiculo}", "VeiculoController@edit")->name("editVeiculo");
Route::post("/veiculo/store", "VeiculoController@store")->name("storeVeiculo");
Route::put("/veiculo/update/{idVeiculo}", "VeiculoController@update")->name("updateVeiculo");
Route::get("/veiculo/delete/{idVeiculo}", "VeiculoController@delete")->name("deleteVeiculo");
Route::get("/veiculo/details/{idVeiculo}", "VeiculoController@details")->name("detailsVeiculo");

Route::get("/veiculo/checkBarcode", "VeiculoController@checkBarcode")->name("checkBarcode");

Route::get("/relatoriotrafego", "RelatorioTrafegoController@index")->name("indexRelatorioTrafego");
Route::get('getSecretaria', 'RelatorioTrafegoController@getSecretaria');
Route::get('getVeiculos', 'RelatorioTrafegoController@getVeiculos');
Route::get('getMotoristas', 'RelatorioTrafegoController@getMotoristas');
Route::get('getVeiculosMotoristas', 'RelatorioTrafegoController@getVeiculosMotoristas');
Route::get('getLista', 'RelatorioTrafegoController@getLista');
Route::get('getPesquisa', 'RelatorioTrafegoController@getPesquisa');

Route::get("/horastrabalhadas", "HorasTrabalhadasController@index")->name("indexHorasTrabalhadas");

Route::get("/quilometrosrodados", "QuilometrosRodadosController@index")->name("indexQuilometrosRodados");

Route::get('/motorista', 'MotoristaController@index')->name("indexMotorista");
Route::get("/motorista/create", "MotoristaController@create")->name("createMotorista");
Route::get("/motorista/edit/{idMotorista}", "MotoristaController@edit")->name("editMotorista");
Route::post("/motorista/store", "MotoristaController@store")->name("storeMotorista");
Route::put("/motorista/update/{idMotorista}", "MotoristaController@update")->name("updateMotorista");
Route::get("/motorista/cnhvenc", "MotoristaController@vencimentoCnh")->name("vencimentoCnh");
Route::get("/motorista/relatorio", "MotoristaController@indexRelatorio")->name("indexRelatorioMotorista");
Route::get('/motorista/details/{idMotorista}',"MotoristaController@details")->name('detailsMotorista');
Route::get('/motorista/delete/{idMotorista}',"MotoristaController@delete")->name('deleteMotorista');
Route::get('/motorista/deleteSenhaMotorista/{idMotorista}',"MotoristaController@deleteSenhaMotorista")->name('deleteSenhaMotorista');
Route::get('defineSenhaMotorista',"MotoristaController@defineSenhaMotorista");
Route::get('getMotoristaById', "MotoristaController@getMotoristaById");

Route::get("/jornada-trabalho", "JornadaTrabalhoController@index")->name("indexJornadaTrabalho");
Route::get("/jornada-trabalho/create", "JornadaTrabalhoController@create")->name("createJornadaTrabalho");
Route::get("/jornada-trabalho/edit/{idJornadaTrabalho}", "JornadaTrabalhoController@edit")->name("editJornadaTrabalho");
Route::post("/jornada-trabalho/store", "JornadaTrabalhoController@store")->name("storeJornadaTrabalho");
Route::put("/jornada-trabalho/update/{idJornadaTrabalho}", "JornadaTrabalhoController@update")->name("updateJornadaTrabalho");

Route::get('/cacamba', 'CacambaController@index')->name("indexCacamba");
Route::get("/cacamba/create", "CacambaController@create")->name("createCacamba");
Route::get("/cacamba/edit/{idCacamba}", "CacambaController@edit")->name("editCacamba");
Route::post("/cacamba/store", "CacambaController@store")->name("storeCacamba");
Route::put("/cacamba/update/{idCacamba}", "CacambaController@update")->name("updateCacamba");

Route::get('/tipo-entulho', 'TipoEntulhoController@index')->name("indexTipoEntulho");
Route::get("/tipo-entulho/create", "TipoEntulhoController@create")->name("createTipoEntulho");
Route::get("/tipo-entulho/edit/{idTipoEntulho}", "TipoEntulhoController@edit")->name("editTipoEntulho");
Route::post("/tipo-entulho/store", "TipoEntulhoController@store")->name("storeTipoEntulho");
Route::put("/tipo-entulho/update/{idTipoEntulho}", "TipoEntulhoController@update")->name("updateTipoEntulho");

Route::get('/ordem-coleta', 'OrdemColetaController@index')->name("indexOrdemColeta");
Route::get("/ordem-coleta/create", "OrdemColetaController@create")->name("createOrdemColeta");
Route::get("/ordem-coleta/edit/{idOrdemColeta}", "OrdemColetaController@edit")->name("editOrdemColeta");
Route::post("/ordem-coleta/store", "OrdemColetaController@store")->name("storeOrdemColeta");
Route::put("/ordem-coleta/update/{idOrdemColeta}", "OrdemColetaController@update")->name("updateOrdemColeta");

//Ordem de Coleta
Route::get("/controle-transpote-residuo", "CTRController@index")->name("indexCTR");
Route::get("/controle-transpote-residuo/formulario{ordemid}", "CTRController@formulario_ctr")->name("ctr.formulario");
Route::get("recusar-solicitacao-cacamba", "CTRController@recusar");
Route::get("aceitar-solicitacao-cacamba", "CTRController@aceitar");

Route::get('/fechar-ordem', 'OrdemColetaController@close')->name("closeOrdemColeta");
Route::get('getCaminhoes', 'OrdemColetaController@getCaminhoes')->name('getCaminhoes');
Route::get('getOrdensColeta', 'OrdemColetaController@getOrdensColeta')->name('getOrdensColeta');
Route::get('updateDataOrdemColeta', 'OrdemColetaController@updateDataOrdemColeta')->name('updateDataOrdemColeta');

//MANUTENÇÃO
//Home
Route::get('/home-manutencao', 'HomeManutencaoController@index')->name('homeManutencao');

//Parâmetros
Route::get("/tipo-veiculo", "TipoVeiculoController@index")->name("indexTipoVeiculo");
Route::get("/tipo-veiculo/create", "TipoVeiculoController@create")->name("createTipoVeiculo");
Route::get("/tipo-veiculo/edit/{idTipoVeiculo}", "TipoVeiculoController@edit")->name("editTipoVeiculo");
Route::post("/tipo-veiculo/store", "TipoVeiculoController@store")->name("storeTipoVeiculo");
Route::put("/tipo-veiculo/update/{idTipoVeiculo}", "TipoVeiculoController@update")->name("updateTipoVeiculo");
Route::get("/tipo-veiculo/delete/{idTipoVeiculo}", "TipoVeiculoController@delete")->name("deleteTipoVeiculo");
Route::get("/tipo-veiculo/details/{idTipoVeiculo}", "TipoVeiculoController@details")->name("detailsTipoVeiculo");

Route::get("/tipo-padroes", "TipoPadroesController@index")->name("indexTipoPadroes");
Route::get("/tipo-padroes/create", "TipoPadroesController@create")->name("createTipoPadroes");
Route::get("/tipo-padroes/edit/{idTipoPadroes}", "TipoPadroesController@edit")->name("editTipoPadroes");
Route::post("/tipo-padroes/store", "TipoPadroesController@store")->name("storeTipoPadroes");
Route::put("/tipo-padroes/update/{idTipoPadroes}", "TipoPadroesController@update")->name("updateTipoPadroes");

Route::get("/padrao", "PadraoController@index")->name("indexPadrao");
Route::get("/padrao/create", "PadraoController@create")->name("createPadrao");
Route::get("/padrao/edit/{idPadrao}", "PadraoController@edit")->name("editPadrao");
Route::post("/padrao/store", "PadraoController@store")->name("storePadrao");
Route::put("/padrao/update/{idPadrao}", "PadraoController@update")->name("updatePadrao");

Route::get("/tipo-exames", "TipoExamesController@index")->name("indexTipoExame");
Route::get("/tipo-exames/create", "TipoExamesController@create")->name("createTipoExame");
Route::get("/tipo-exames/edit/{idTipoExame}", "TipoExamesController@edit")->name("editTipoExame");
Route::post("/tipo-exames/store", "TipoExamesController@store")->name("storeTipoExame");
Route::put("/tipo-exames/update/{idTipoExame}", "TipoExamesController@update")->name("updateTipoExame");

Route::get("/exame", "ExameController@index")->name("indexExame");
Route::get("/exame/create", "ExameController@create")->name("createExame");
Route::get("/exame/edit/{idExame}", "ExameController@edit")->name("editExame");
Route::post("/exame/store", "ExameController@store")->name("storeExame");
Route::put("/exame/update/{idExame}", "ExameController@update")->name("updateExame");

Route::get("/secretaria", "SecretariaController@index")->name("indexSecretaria");
Route::get("/secretaria/create", "SecretariaController@create")->name("createSecretaria");
Route::get("/secretaria/edit/{idSecretaria}", "SecretariaController@edit")->name("editSecretaria");
Route::post("/secretaria/store", "SecretariaController@store")->name("storeSecretaria");
Route::put("/secretaria/update/{idSecretaria}", "SecretariaController@update")->name("updateSecretaria");
Route::get("/secretaria/delete/{idSecretaria}","SecretariaController@delete")->name("deleteSecretaria");
Route::get("/secretaria/details/{idSecretaria}","SecretariaController@details")->name("detailsSecretaria");

Route::get("/tipo-preventiva", "TipoPreventivaController@index")->name("indexTipoPreventiva");
Route::get("/tipo-preventiva/create", "TipoPreventivaController@create")->name("createTipoPreventiva");
Route::get("/tipo-preventiva/edit/{idTipoPreventiva}", "TipoPreventivaController@edit")->name("editTipoPreventiva");
Route::post("/tipo-preventiva/store", "TipoPreventivaController@store")->name("storeTipoPreventiva");
Route::put("/tipo-preventiva/update/{idTipoPreventiva}", "TipoPreventivaController@update")->name("updateTipoPreventiva");

Route::get("/icone-cidade-facil", "IconesCidadeFacilController@index")->name("indexIconesCidadeFacil");
Route::get("/icone-cidade-facil/create", "IconesCidadeFacilController@create")->name("createIconesCidadeFacil");
Route::get("/icone-cidade-facil/edit/{idIcone}", "IconesCidadeFacilController@edit")->name("editIconesCidadeFacil");
Route::post("/icone-cidade-facil/store", "IconesCidadeFacilController@store")->name("storeIconesCidadeFacil");
Route::put("/icone-cidade-facil/update/{idIcone}", "IconesCidadeFacilController@update")->name("updateIconesCidadeFacil");

Route::get('downloadIcone', 'IconesCidadeFacilController@downloadIcone')->name('downloadIcone');

Route::get("/role-icon", "RoleIconsController@index")->name("indexRoleIcons");
Route::post("/role-icon/store", "RoleIconsController@store")->name("storeRoleIcons");

Route::get("/unidade-intervalo", "UnidadeIntervaloController@index")->name("indexUnidadeIntervalo");
Route::get("/unidade-intervalo/create", "UnidadeIntervaloController@create")->name("createUnidadeIntervalo");
Route::get("/unidade-intervalo/edit/{idUnidadeIntervalo}", "UnidadeIntervaloController@edit")->name("editUnidadeIntervalo");
Route::post("/unidade-intervalo/store", "UnidadeIntervaloController@store")->name("storeUnidadeIntervalo");
Route::put("/unidade-intervalo/update/{idUnidadeIntervalo}", "UnidadeIntervaloController@update")->name("updateUnidadeIntervalo");

Route::get("/preventiva", "PreventivaController@index")->name("indexPreventiva");
Route::get("/preventiva/create", "PreventivaController@create")->name("createPreventiva");
Route::get("/preventiva/edit/{idPreventiva}", "PreventivaController@edit")->name("editPreventiva");
Route::post("/preventiva/store", "PreventivaController@store")->name("storePreventiva");
Route::put("/preventiva/update/{idPreventiva}", "PreventivaController@update")->name("updatePreventiva");

Route::get("/responsavel", "ResponsavelController@index")->name("indexResponsavel");
Route::get("/responsavel/create", "ResponsavelController@create")->name("createResponsavel");
Route::get("/responsavel/edit/{idResponsavel}", "ResponsavelController@edit")->name("editResponsavel");
Route::post("/responsavel/store", "ResponsavelController@store")->name("storeResponsavel");
Route::put("/responsavel/update/{idResponsavel}", "ResponsavelController@update")->name("updateResponsavel");

Route::get("/veiculos-exames", "VeiculosExamesController@index")->name("indexVeiculosExames");
Route::get("/veiculos-exames/create", "VeiculosExamesController@create")->name("createVeiculosExames");
//Route::get("/veiculos-exames/edit/{idVeiculoExame}", "VeiculosExamesController@edit")->name("editVeiculosExames");
Route::post("/veiculos-exames/store", "VeiculosExamesController@store")->name("storeVeiculosExames");
Route::get("/veiculos-exames/delete", "VeiculosExamesController@easyDelete")->name("deleteVeiculosExames");
//Route::put("/veiculos-exames/update/{idVeiculoExame}", "VeiculosExamesController@update")->name("updateVeiculosExames");
Route::get("/veiculos-rpm", "VeiculosRpmController@index")->name("veiculosRpm");
Route::get("/veiculos-rpm/create", "VeiculosRpmController@create")->name("createVeiculosRpm");
Route::post("/veiculos-rpm/store", "VeiculosRpmController@store")->name("storeVeiculosRpm");
Route::post("/veiculos-rpm/updated", "VeiculosRpmController@updated")->name("updatedVeiculosRpm");
Route::get("/veiculos-rpm/update/{idVeiculo}", "VeiculosRpmController@update")->name("updateVeiculosRpm");

Route::get("/tipos-alerta", "TiposAlertaController@index")->name("tiposAlerta.index");
Route::get("/tipos-alerta/create", "TiposAlertaController@create")->name("tiposAlerta.create");
Route::post("/tipos-alerta/store", "TiposAlertaController@store")->name("tiposAlerta.store");

//JSON
Route::get('getPadroes', 'ExameController@getPadroes')->name('getPadroes');
Route::get('getVeiculoEspecifico', 'PreventivaController@getVeiculoEspecifico')->name('getVeiculoEspecifico');
Route::get('getExamesDoVeiculo', 'VeiculosExamesController@getExamesDoVeiculo')->name('getExamesDoVeiculo');

//Outras Funcionalidades Manutenção
Route::get("/cronograma-manutencao", "CronogramaManutencaoController@index")->name("indexCronogramaManutencao");
Route::post("/cronograma-manutencao/store", "CronogramaManutencaoController@store")->name("storeCronogramaManutencao");

Route::get("/preventiva-pendente", "PreventivaPendenteController@index")->name("indexPreventivaPendente");

Route::get("/corretiva", "OrdemServicoCorretivaController@index")->name("indexCorretiva");
Route::get("/corretiva/create", "OrdemServicoCorretivaController@create")->name("createCorretiva");
Route::post("/corretiva/store", "OrdemServicoCorretivaController@store")->name("storeCorretiva");
Route::get('/corretiva/edit/{id}', 'OrdemServicoCorretivaController@edit')->name('editCorretiva');
Route::put("/corretiva/update/{id}", "OrdemServicoCorretivaController@update")->name("updateCorretiva");
Route::get('corretiva/downloadAllImagemVeiculo', 'OrdemServicoCorretivaController@downloadAllImagemVeiculo')->name('downloadAllImagemVeiculo');



Route::get("/manutencao/relatorio", "RelatorioManutencoesController@indexRelatorio")->name("indexRelatorioManutencao");
Route::get("/manutencao/gerar", "RelatorioManutencoesController@gerarRelatorio")->name("gerarRelatorioManutencao");

Route::get("/percentual-produtividade/relatorio", "PercentualProdutividadeController@indexProdutividade")->name("indexProdutividade");
Route::get("/percentual-produtividade/gerar", "PercentualProdutividadeController@gerarRelatorioProdutividade")->name("gerarRelatorioProdutividade");

//JSON
Route::get('getTipoPreventiva', 'CronogramaManutencaoController@getTipoPreventiva')->name('getTipoPreventiva');
Route::get('getOrdemServico', 'CronogramaManutencaoController@getOrdemServico')->name('getOrdemServico');
Route::get('getVeiculosPorSecretaria', 'CronogramaManutencaoController@getVeiculosPorSecretaria')->name('getVeiculosPorSecretaria');

//OUTROS MÓDULOS
Route::get('/prazo', 'ParametroController@index')->name("indexPrazo");
Route::get('/prazo/create', 'ParametroController@create')->name('createPrazo');
Route::put('/prazo/update', 'ParametroController@update')->name('updatePrazo');

// Horários Programados
Route::get("/horario-programado", "HorarioProgramadoController@index")->name("indexHorarioProgramado");
Route::get("/horario-programado/create", "HorarioProgramadoController@create")->name("createHorarioProgramado");
Route::get("/horario-programado/edit/{idHorarioProgramado}", "HorarioProgramadoController@edit")->name("editHorarioProgramado");
Route::post("/horario-programado/store", "HorarioProgramadoController@store")->name("storeHorarioProgramado");
Route::put("/horario-programado/update/{idHorarioProgramado}", "HorarioProgramadoController@update")->name("updateHorarioProgramado");
Route::get("/horario-programado/delete/{idHorarioProgramado}","HorarioProgramadoController@delete")->name("deleteHorarioProgramado");
Route::get("/horario-programado/details/{idHorarioProgramado}","HorarioProgramadoController@details")->name("detailsHorarioProgramado");

// Poligonos
Route::get('/poligonos', 'PoligonoController@index')->name("indexPoligono");
Route::get("/poligonos/create", "PoligonoController@create")->name("createPoligono");
Route::get("/poligonos/edit/{idPoligono}", "PoligonoController@edit")->name("editPoligono");
Route::post("/poligonos/store", "PoligonoController@store")->name("storePoligono");
Route::put("/poligonos/update/{idPoligono}", "PoligonoController@update")->name("updatePoligono");

// Vértices das Cercas
//Route::get("/vertice-cerca", "VerticesPoligonoController@index")->name("indexVerticeCerca");
Route::get("/vertice/create", "VerticesPoligonoController@create")->name("createVerticeCerca");
Route::get("/vertice/edit/{idCercaEletronica}", "VerticesPoligonoController@edit")->name("editVerticeCerca");
//Route::post("/vertice-cerca/store", "VerticesPoligonoController@store")->name("storeVerticeCerca");
Route::get("/vertice/storeVertices", "VerticesPoligonoController@storeVertices")->name("storeVerticeCerca");
Route::put("/vertice/update/{idCercaEletronica}", "VerticesPoligonoController@update")->name("updateVerticeCerca");

Route::get("/vertice-show", "VerticesPoligonoController@show")->name("showVerticeCerca");
Route::get("/vertice-draw", "VerticesPoligonoController@draw")->name("drawVerticeCerca");
Route::get("/vertice-points", "VerticesPoligonoController@setPoints")->name("pointsVerticeCerca");

// Cercas Relacionadas aos Veículos
Route::get("/cerca-veiculo", "CercasVeiculoController@index")->name("indexCercaVeiculo");
Route::get("/cerca-veiculo/create", "CercasVeiculoController@create")->name("createCercaVeiculo");
Route::get("/cerca-veiculo/edit/{idCercaVeiculo}", "CercasVeiculoController@edit")->name("editCercaVeiculo");
Route::post("/cerca-veiculo/store", "CercasVeiculoController@store")->name("storeCercaVeiculo");
Route::put("/cerca-veiculo/update/{idCercaVeiculo}", "CercasVeiculoController@update")->name("updateCercaVeiculo");

// Rotas relacionadas aos Veículos
Route::get("/rota-veiculo", "RotasVeiculosController@index")->name("indexRotaVeiculo");
Route::get("/rota-veiculo/create", "RotasVeiculosController@create")->name("createRotaVeiculo");
Route::get("/rota-veiculo/edit/{idRotaVeiculo}", "RotasVeiculosController@edit")->name("editRotaVeiculo");
Route::post("/rota-veiculo/store", "RotasVeiculosController@store")->name("storeRotaVeiculo");
Route::put("/rota-veiculo/update/{idRotaVeiculo}", "RotasVeiculosController@update")->name("updateRotaVeiculo");
Route::get("/rota-veiculo/delete/{idRotaVeiculo}", "RotasVeiculosController@delete")->name("deleteRotaVeiculo");

Route::get('/termo-compromisso', 'PrefeituraController@index')->name('termoCompromisso');
Route::post('/termo-compromisso/store', 'PrefeituraController@store')->name('termoCompromissoStore');

//Diario de bordo veiculos
Route::get('/diariodebordo', 'DiarioDeBordoController@index');
Route::get('getAllVeiculos', 'DiarioDeBordoController@getAllVeiculos');
Route::get('getEventosVeiculo', 'DiarioDeBordoController@getEventosVeiculo');
Route::get('getLogo', 'DiarioDeBordoController@getLogo');
Route::get('getResumo', 'DiarioDeBordoController@getResumo');
Route::get('getBuscaDiarioBordo', 'DiarioDeBordoController@getBuscaDiarioBordo');
Route::get('getDownload', 'DiarioDeBordoController@getDownload');

//GRAFICOS

Route::get('getPrefeitura', 'GraficoController@getPrefeitura')->name('getPrefeitura');

Route::get('/grafico', 'GraficoController@index')->name("indexGrafico");

Route::get('/grafico/gasto-manutencao', 'GraficoController@gastoManutencao')->name("indexGastoManutencao");
Route::get('/getGastoManutencao', 'GraficoController@getGastoManutencao')->name('getGastoManutencao');
Route::get('/getManutencaoSecretaria', 'GraficoController@getManutencaoSecretaria')->name('getManutencaoSecretaria');
Route::get('/getManutencaoMes', 'GraficoController@getManutencaoMes')->name('getManutencaoMes');
Route::get('/getManutencaoVeiculo', 'GraficoController@getManutencaoVeiculo')->name('getManutencaoVeiculo');

Route::get('/grafico/arrecadacao-protocolo', 'GraficoController@arrecadacaoProtocolo')->name("indexArrecadacaoProtocolo");
Route::get('/getArrecadacaoProtocolo', 'GraficoController@getArrecadacaoProtocolo')->name('getArrecadacaoProtocolo');
Route::get('/getProtocoloMes', 'GraficoController@getProtocoloMes')->name('getProtocoloMes');
Route::get('/getManutencaoAssunto', 'GraficoController@getManutencaoAssunto')->name('getManutencaoAssunto');

Route::get('/grafico/cacambas-entregues', 'GraficoController@cacambaEntregue')->name("indexCacambaEntregue");
Route::get('/getCacambaEntregue', 'GraficoController@getCacambaEntregue')->name('getCacambaEntregue');
Route::get('/getCacambaMes', 'GraficoController@getCacambaMes')->name('getCacambaMes');
Route::get('/getCacambaEmpresa', 'GraficoController@getCacambaEmpresa')->name('getCacambaEmpresa');

//JSON
Route::get('getRuas', 'OrdemColetaController@getRuas')->name('getRuas');
Route::get('getNumeros', 'OrdemColetaController@getNumeros')->name('getNumeros');
Route::get('getVertices', 'VerticesPoligonoController@getVertices')->name('getVertices');
Route::get('getIdsVertices', 'VerticesPoligonoController@getIdsVertices')->name('getIdsVertices');

//Controle de Acesso

Route::get('/perfil', 'PerfilController@index')->name('perfil.index');
Route::get('/perfil/show/{id}', 'PerfilController@edit')->name('perfil.show');
Route::get('/perfil/create', 'PerfilController@create')->name('perfil.create');
Route::post('/perfil/store', 'PerfilController@store')->name('perfil.store');
Route::get('/perfil/edit/{id}', 'PerfilController@edit')->name('perfil.edit');
Route::put('/perfil/update/{id}', 'PerfilController@update')->name('perfil.update');

Route::get('/permissao', 'PermissaoController@index')->name('permissao.index');
Route::get('/permissao/show/{id}', 'PermissaoController@edit')->name('permissao.show');
Route::get('/permissao/create', 'PermissaoController@create')->name('permissao.create');
Route::post('/permissao/store', 'PermissaoController@store')->name('permissao.store');
Route::get('/permissao/edit/{id}', 'PermissaoController@edit')->name('permissao.edit');
Route::put('/permissao/update/{id}', 'PermissaoController@update')->name('permissao.update');

//Postos de Gasolina
Route::get('/postosdegasolina', "PostosDeGasolinaController@index")->name("indexPosto");
Route::get("/postosdegasolina/create", "PostosDeGasolinaController@create")->name("createPosto");
Route::get("/postosdegasolina/edit/{idPosto}", "PostosDeGasolinaController@edit")->name("editPosto");
Route::post("/postosdegasolina/store", "PostosDeGasolinaController@store")->name("storePosto");
Route::put("/postosdegasolina/update/{idPosto}", "PostosDeGasolinaController@update")->name("updatePosto");
Route::get("/postosdegasolina/details/{idPosto}","PostosDeGasolinaController@details")->name("detailsPosto");
Route::get("/postosdegasolina/delete/{idPosto}","PostosDeGasolinaController@delete")->name("deletePosto");

Route::post("/hash", "PostosDeGasolinaController@hash")->name("hash");

//Veiculos Cota
Route::get('/veiculoscota', 'VeiculosCotaController@index')->name('veiculocotasindex');
Route::get('/getVeiculosSecretariaSelect', 'VeiculosCotaController@getVeiculosSecretariaSelect')->name('getVeiculosSecretariaSelect');
Route::get('/getallsecretarias', 'VeiculosCotaController@getAllSecretarias')->name('getAllSecretarias');
Route::get('/getVeiculosCotasPorSecretaria', 'VeiculosCotaController@getVeiculosCotasPorSecretaria')->name('getVeiculosCotasPorSecretaria');
Route::get('/getVeiculosCotasPorVeiculos', 'VeiculosCotaController@getVeiculosCotasPorVeiculos')->name('getVeiculosCotasPorVeiculos');
Route::get('/getVeiculosCotasFiltros', 'VeiculosCotaController@getVeiculosCotasFiltros')->name('getVeiculosCotasFiltros');
Route::get('/getVeiculosCotasPorMes', 'VeiculosCotaController@getVeiculosCotasPorMes')->name('getVeiculosCotasPorMes');
Route::get('/getAllVeiculosCotas', 'VeiculosCotaController@getAllVeiculosCotas')->name('getAllVeiculosCotas');
Route::get('/updateVeiculosCota', 'VeiculosCotaController@updateVeiculosCota')->name('updateVeiculosCota');
Route::get('/relatorio-cotas', 'VeiculosCotaController@relatorioCotas')->name('relatorio-cotas');
Route::get('getRelatorioCotas', 'VeiculosCotaController@getRelatorioCotas');
Route::get('/relatorio-cotas-periodo', 'VeiculosCotaController@relatorioCotasPeriodo')->name('relatorio-cotas-periodo');
Route::get('getRelatorioCotasPeriodo', 'VeiculosCotaController@getRelatorioCotasPeriodo');
Route::get('getVeiculosToRelatorioPeriodo', 'VeiculosCotaController@getVeiculosToRelatorioPeriodo');
Route::get('getPostosToRelatorioPeriodo', 'VeiculosCotaController@getPostosToRelatorioPeriodo');
Route::get('getServidoresToRelatorioPeriodo', 'VeiculosCotaController@getServidoresToRelatorioPeriodo');
Route::get('getTipoCombustivel', 'VeiculosCotaController@getTipoCombustivel');
Route::get('getPostos', 'VeiculosCotaController@getPostos');
Route::get('deleteAbastecimento', 'VeiculosCotaController@deleteAbastecimento');



//Secretaria
Route::get('/pintura', 'PinturaController@index')->name('pintura.index');

//Abastecimento

Route::get('abastecimento/downloadImagemVeiculo', 'AbastecimentoController@downloadImagemVeiculo')->name('downloadImagemVeiculo');
Route::get('abastecimento/downloadImagemVeiculoPlaca', 'AbastecimentoController@downloadImagemVeiculoPlaca')->name('downloadImagemVeiculoPlaca');
Route::get('/abastecimento', 'AbastecimentoController@index')->name('abastecimento.index');
Route::post('/abastecimento/store', 'AbastecimentoController@store')->name('abastecimento.store');
Route::get('/getVeiculoAbastecimento', 'AbastecimentoController@getVeiculoAbastecimento')->name('getVeiculoAbastecimento');
Route::get('/getIdVeiculoAbastecimento', 'AbastecimentoController@getIdVeiculoAbastecimento')->name('getIdVeiculoAbastecimento');
Route::get('/getMotoristaCredencial', 'AbastecimentoController@getMotoristaCredencial')->name('getMotoristaCredencial');
Route::get('/getFrentistaCredencial', 'AbastecimentoController@getFrentistaCredencial')->name('getFrentistaCredencial');
Route::get('/getMotoristaExistente', 'AbastecimentoController@getMotoristaExistente')->name('getMotoristaExistente');
Route::get('/motoristaSenhaCheck', 'AbastecimentoController@motoristaSenhaCheck')->name('motoristaSenhaCheck');
Route::get('/frentistaSenhaCheck', 'AbastecimentoController@frentistaSenhaCheck')->name('frentistaSenhaCheck');
Route::post('/motoristaSenhaStore', 'AbastecimentoController@motoristaSenhastore')->name('motoristaSenhaStore');
Route::post('/frentistaSenhaStore', 'AbastecimentoController@frentistaSenhastore')->name('frentistaSenhaStore');
Route::get('/getKilometragem', 'AbastecimentoController@getKilometragem')->name('getKilometragem');
Route::post('updateKilometro', 'AbastecimentoController@updateKilometro')->name('updateKilometro');
Route::get('getUltimoAbastecimento', 'AbastecimentoController@getUltimoAbastecimento')->name('getUltimoAbastecimento');
Route::post('updateUltimoAbastecimento', 'AbastecimentoController@updateUltimoAbastecimento')->name('updateUltimoAbastecimento');
Route::post('consultaCartaoMestre', 'AbastecimentoController@consultaCartaoMestre')->name('consultaCartaoMestre');
Route::get('getVeiculoEquipamento', 'AbastecimentoController@getVeiculoEquipamento')->name('getVeiculoEquipamento');

Route::get('/abastecimento/manual', 'AbastecimentoController@manual')->name('createAbastecimentoManual');
Route::post('/abastecimento/storeAbastecimentoManual', 'AbastecimentoController@storeAbastecimentoManual')->name('storeAbastecimentoManual');

//Combustível
Route::get("/tipo-combustiveis", "TipoCombustivelController@index")->name("indexTipoCombustivel");
Route::get("/tipo-combustiveis/create", "TipoCombustivelController@create")->name("createTipoCombustivel");
Route::get("/tipo-combustiveis/edit/{idTipoCombustivel}", "TipoCombustivelController@edit")->name("editTipoCombustivel");
Route::post("/tipo-combustiveis/store", "TipoCombustivelController@store")->name("storeTipoCombustivel");
Route::put("/tipo-combustiveis/update/{idTipoCombustivel}", "TipoCombustivelController@update")->name("updateTipoCombustivel");
Route::get("/tipo-combustiveis/delete/{idTIpoCombustivel}", "TipoCombustivelController@delete")->name("deleteTipoCombustivel");
Route::get("/tipo-combustiveis/details/{idTIpoCombustivel}", "TipoCombustivelController@details")->name("detailsTipoCombustivel");

//AbastecimentoHistorico

Route::get('/abastecimentoHistorico', 'AbastecimentoHistoricoController@index')->name('abastecimentoHistorico');
Route::get('/autorizacaoAbastecimento/{id}', 'AbastecimentoHistoricoController@autorizacaoAbastecimento')->name('autorizacaoAbastecimento');

//AbastecimentoGrafico
Route::get('/graficoAbastecimento', "GraficoAbastecimentoController@index")->name("graficoAbastecimento");//view

Route::get('/getVolumeTotalMes', "GraficoAbastecimentoApiController@getVolumeTotalMes")->name("getVolumeTotalMes");
Route::get('/getVolumeTotalSecretaria', "GraficoAbastecimentoApiController@getVolumeTotalSecretaria")->name("getVolumeTotalSecretaria");
Route::get('/getVolumeTotalSecretFornecedor', "GraficoAbastecimentoApiController@getVolumeTotalSecretFornecedor")->name("getVolumeTotalSecretFornecedor");
Route::get('getVolumeTotalSubSetorVeiculo', "GraficoAbastecimentoApiController@getVolumeTotalSubSetorVeiculo")->name("getVolumeTotalSubSetorVeiculo");
Route::get('getVolumeTotalVeiculoDia', "GraficoAbastecimentoApiController@getVolumeTotalVeiculoDia")->name("getVolumeTotalVeiculoDia");

//Grafico Km Litro
Route::get('graficoKmLitro', "GraficoAbastecimentoController@graficoKmLitro")->name("graficoKmLitro"); //view

Route::get('getKmLitroMes', "GraficoAbastecimentoApiController@getKmLitroMes")->name("getKmLitroMes");
Route::get('getKmLitroSetor', "GraficoAbastecimentoApiController@getKmLitroSetor")->name("getKmLitroSetor");
Route::get('getKmLitroSubSetor', "GraficoAbastecimentoApiController@getKmLitroSubSetor")->name("getKmLitroSubSetor");
Route::get('getKmLitroVeiculo', "GraficoAbastecimentoApiController@getKmLitroVeiculo")->name("getKmLitroVeiculo");
Route::get('getKmLitroDia', "GraficoAbastecimentoApiController@getKmLitroDia")->name("getKmLitroDia");

//Setores
Route::get("/despesa-setor", "DespesaSetoresController@index")->name("indexDespesaSetores");
Route::get("/despesa-setor/create", "DespesaSetoresController@create")->name("createDespesaSetores");
Route::get("/despesa-setor/edit/{idDespesaSetor}", "DespesaSetoresController@edit")->name("editDespesaSetores");
Route::post("/despesa-setor/store", "DespesaSetoresController@store")->name("storeDespesaSetores");
Route::put("/despesa-setor/update/{idDespesaSetor}", "DespesaSetoresController@update")->name("updateDespesaSetores");
Route::get("/despesa-setor/delete/{idDespesaSetor}","DespesaSetoresController@delete")->name("deleteDespesaSetores");

Route::get("/despesa-sub-setor", "DespesaSubSetoresController@index")->name("indexDespesaSubSetores");
Route::get("/despesa-sub-setor/create", "DespesaSubSetoresController@create")->name("createDespesaSubSetores");
Route::get("/despesa-sub-setor/edit/{idDespesaSubSetor}", "DespesaSubSetoresController@edit")->name("editDespesaSubSetores");
Route::post("/despesa-sub-setor/store", "DespesaSubSetoresController@store")->name("storeDespesaSubSetores");
Route::put("/despesa-sub-setor/update/{idDespesaSubSetor}", "DespesaSubSetoresController@update")->name("updateDespesaSubSetores");
Route::get('getSubSetores', 'DespesaSubSetoresController@getSubSetores');
Route::get('getSetores', 'DespesaSetoresController@getSetores');
Route::get("/despesa-sub-setor/delete/{idDespesaSubSetor}","DespesaSubSetoresController@delete")->name("deleteDespesaSubSetores");
Route::get("/despesa-sub-setor/details/{idDespesaSubSetor}","DespesaSubSetoresController@details")->name("detailsDespesaSubSetores");

//Frentista
Route::get('/frentista', 'FrentistaController@index')->name('indexFrentista');
Route::get("/frentista/searchFrentista","FrentistaController@search")->name('searchFrentista');
Route::post('/frentista/searchFrentista', 'FrentistaController@search')->name('searchFrentista');
Route::get("/frentista/create", "FrentistaController@create")->name("createFrentista");
Route::get("/frentista/edit/{idFrentista}", "FrentistaController@edit")->name("editFrentista");
Route::get("/frentista/resetsenha/{idFrentista}", "FrentistaController@resetSenhaFrentista")->name("resetSenhaFrentista");
Route::post("/frentista/store", "FrentistaController@store")->name("storeFrentista");
Route::put("/frentista/update/{idFrentista}", "FrentistaController@update")->name("updateFrentista");


/////////////////////////////////////////////////////ILUMINAÇÃO/////////////////////////////////////////////////////
//Home
Route::get('/home-iluminacao', 'HomeIluminacaoController@index')->name('homeIluminacao');

Route::get('/anomalia', "AnomaliaController@index")->name("indexAnomalia");
Route::get("/anomalia/create", "AnomaliaController@create")->name("createAnomalia");
Route::get("/anomalia/edit/{idAnomalia}", "AnomaliaController@edit")->name("editAnomalia");
Route::post("/anomalia/store", "AnomaliaController@store")->name("storeAnomalia");
Route::put("/anomalia/update/{idAnomalia}", "AnomaliaController@update")->name("updateAnomalia");

Route::get('/status-solicitacao', "StatusSolicitacaoController@index")->name("indexStatusSolicitacao");
Route::get("/status-solicitacao/create", "StatusSolicitacaoController@create")->name("createStatusSolicitacao");
Route::get("/status-solicitacao/edit/{idStatus}", "StatusSolicitacaoController@edit")->name("editStatusSolicitacao");
Route::post("/status-solicitacao/store", "StatusSolicitacaoController@store")->name("storeStatusSolicitacao");
Route::put("/status-solicitacao/update/{idStatus}", "StatusSolicitacaoController@update")->name("updateStatusSolicitacao");

Route::get('/status-cacamba', "StatusCacambaController@index")->name("indexStatusCacamba");
Route::get("/status-cacamba/create", "StatusCacambaController@create")->name("createStatusCacamba");
Route::get("/status-cacamba/edit/{idCacamba}", "StatusCacambaController@edit")->name("editStatusCacamba");
Route::post("/status-cacamba/store", "StatusCacambaController@store")->name("storeStatusCacamba");
Route::put("/status-cacamba/update/{idCacamba}", "StatusCacambaController@update")->name("updateStatusCacamba");

Route::get('/solicitacoes-rede-eletrica', 'SolicitacaoRedeEletricaController@index')->name('indexSolicitacaoRedeEletrica');
Route::get('getSolicitacoes', 'SolicitacaoRedeEletricaController@getSolicitacoes')->name('getSolicitacoes');
Route::get("cancelar-solicitacao-rede-eletrica", "SolicitacaoRedeEletricaController@cancelar");
Route::get("finalizar-solicitacao-rede-eletrica", "SolicitacaoRedeEletricaController@finalizar");

Route::get("relatoriomanutencaoeletrica/{id}", "RelatorioOrdemDeServicoController@index")->name("gerarManutencaoEletrica");

/////////////////////////////////////////////////////CONTROLE DE ACESSO/////////////////////////////////////////////////////
Route::get('/controle-acesso', 'ControleAcessoController@index')->name('controleAcesso');

Route::get('/icone-item-cidade-facil', 'IconItemCidadeFacilController@index')->name('indexIconeItemCidadeFacil');
Route::get('/get-itens', 'ControleAcessoController@getItens')->name('getItens');
Route::get('/get-itens-icon-checked', 'IconItemCidadeFacilController@getItensIconChecked')->name('getItensIconChecked');
Route::get('/get-icon-image', 'ControleAcessoController@getIconImage')->name('getIconImage');
Route::post('/set-icon-item', 'IconItemCidadeFacilController@store')->name('setIconItem');

Route::get('/perfil-item-cidade-facil', 'PerfilItemCidadeFacilController@index')->name('indexPerfilItemCidadeFacil');
Route::get('/get-itens-role-checked', 'PerfilItemCidadeFacilController@getItensRoleChecked')->name('getItensRoleChecked');
Route::post('/set-perfil-item', 'PerfilItemCidadeFacilController@store')->name('setPerfilItem');
Route::get('/get-icons', 'PerfilItemCidadeFacilController@getIcons')->name('getIcons');
Route::get('/get-itens-byicon', 'PerfilItemCidadeFacilController@getItensByIcon')->name('getItensByIcon');

Route::get('/perfil-item-web', 'PerfilItemWebController@index')->name('indexPerfilItemWeb');
Route::get('/get-icons-role-checked-web', 'PerfilItemWebController@getIconsRoleChecked')->name('getIconsRoleCheckedWeb');
Route::get('/get-itens-role-checked-web', 'PerfilItemWebController@getItensRoleChecked')->name('getItensRoleCheckedWeb');
Route::post('/set-perfil-item-web', 'PerfilItemWebController@store')->name('setPerfilItemWeb');
Route::get('/get-icons-web', 'PerfilItemWebController@getIcons')->name('getIconsWeb');
Route::get('/get-itens-byicon-web', 'PerfilItemWebController@getItensByIcon')->name('getItensByIconWeb');

Route::get('perfil-usuario', 'UsuariosPerfisController@index')->name('usuarios.perfis');
Route::post('/set-perfil-usuario-web', 'UsuariosPerfisController@store')->name('setPerfilUsuarioWeb');
Route::get('/get-roles-web', 'UsuariosPerfisController@getRoles')->name('getRolesWeb');
Route::get('/get-roles-user-checked-web', 'UsuariosPerfisController@getRolesUserChecked')->name('getRolesUserChecked');

Route::get('/get-icons-role-checked', 'RoleIconsController@getIconsRoleChecked')->name('getIconsRoleChecked');

Route::get('/item-cidade-facil', "ItemCidadeFacilController@index")->name("indexItemCidadeFacil");
Route::get("/item-cidade-facil/create", "ItemCidadeFacilController@create")->name("createItemCidadeFacil");
Route::get("/item-cidade-facil/edit/{idItem}", "ItemCidadeFacilController@edit")->name("editItemCidadeFacil");
Route::post("/item-cidade-facil/store", "ItemCidadeFacilController@store")->name("storeItemCidadeFacil");
Route::put("/item-cidade-facil/update/{idItem}", "ItemCidadeFacilController@update")->name("updateItemCidadeFacil");

Route::get('/change-password','HomeController@showChangePasswordForm');
Route::post('/change-password','HomeController@changePassword')->name('change-password');

// Cartão Mestre
Route::get('/cartao-mestre', 'CartaoMestreController@index')->name("indexCartaoMestre");
Route::get("/cartao-mestre/create", "CartaoMestreController@create")->name("createCartaoMestre");
Route::get("/cartao-mestre/edit/{idCartaoMestre}", "CartaoMestreController@edit")->name("editCartaoMestre");
Route::post("/cartao-mestre/store", "CartaoMestreController@store")->name("storeCartaoMestre");
Route::put("/cartao-mestre/update/{idCartaoMestre}", "CartaoMestreController@update")->name("updateCartaoMestre");

// CRUD's
//Index
Route::get('/parametros-fiscalizacao', 'ParametrosFiscalizacaoController@index')->name("indexParametrosFiscalizacao");

//revestimento externo
Route::get('/revestexterno', 'RevestExternoController@index')->name("revestexterno.index");
Route::get('/revestexterno/create', 'RevestExternoController@create')->name("revestexterno.create");
Route::get('/revestexterno/edit/{tipo}/{id}', 'RevestExternoController@edit')->name("revestexterno.edit");
Route::get('/revestexterno/delete/{id}', 'RevestExternoController@delete')->name("revestexterno.delete");
Route::post('/revestexterno/store', 'RevestExternoController@store')->name("revestexterno.store");
Route::post('/revestexterno/update', 'RevestExternoController@update')->name("revestexterno.update");

//revestimento interno
Route::get('/revestinterno', 'RevestInternoController@index')->name("revestinterno.index");
Route::get('/revestinterno/create', 'RevestInternoController@create')->name("revestinterno.create");
Route::get('/revestinterno/edit/{tipo}/{id}', 'RevestInternoController@edit')->name("revestinterno.edit");
Route::get('/revestinterno/delete/{id}', 'RevestInternoController@delete')->name("revestinterno.delete");
Route::post('/revestinterno/store', 'RevestInternoController@store')->name("revestinterno.store");
Route::post('/revestinterno/update', 'RevestInternoController@update')->name("revestinterno.update");

//pintura externa
Route::get('/pinturaExt', 'PinturaExtController@index')->name("pinturaExt.index");
Route::get('/pinturaExt/create', 'PinturaExtController@create')->name("pinturaExt.create");
Route::get('/pinturaExt/edit/{tipo}/{id}', 'PinturaExtController@edit')->name("pinturaExt.edit");
Route::get('/pinturaExt/delete/{id}', 'PinturaExtController@delete')->name("pinturaExt.delete");
Route::post('/pinturaExt/store', 'PinturaExtController@store')->name("pinturaExt.store");
Route::post('/pinturaExt/update', 'PinturaExtController@update')->name("pinturaExt.update");

//pintura interna
Route::get('/pinturaInt', 'PinturaIntController@index')->name("pinturaInt.index");
Route::get('/pinturaInt/create', 'PinturaIntController@create')->name("pinturaInt.create");
Route::get('/pinturaInt/edit/{tipo}/{id}', 'PinturaIntController@edit')->name("pinturaInt.edit");
Route::get('/pinturaInt/delete/{id}', 'PinturaIntController@delete')->name("pinturaInt.delete");
Route::post('/pinturaInt/store', 'PinturaIntController@store')->name("pinturaInt.store");
Route::post('/pinturaInt/update', 'PinturaIntController@update')->name("pinturaInt.update");

//piso externo
Route::get('/pisoExterno', 'PisoExteriorController@index')->name("pisoExterno.index");
Route::get('/pisoExterno/create', 'PisoExteriorController@create')->name("pisoExterno.create");
Route::get('/pisoExterno/edit/{tipo}/{id}', 'PisoExteriorController@edit')->name("pisoExterno.edit");
Route::get('/pisoExterno/delete/{id}', 'PisoExteriorController@delete')->name("pisoExterno.delete");
Route::post('/pisoExterno/store', 'PisoExteriorController@store')->name("pisoExterno.store");
Route::post('/pisoExterno/update', 'PisoExteriorController@update')->name("pisoExterno.update");

//piso interno
Route::get('/pisoInterno', 'PisoInteriorController@index')->name("pisoInterno.index");
Route::get('/pisoInterno/create', 'PisoInteriorController@create')->name("pisoInterno.create");
Route::get('/pisoInterno/edit/{tipo}/{id}', 'PisoInteriorController@edit')->name("pisoInterno.edit");
Route::get('/pisoInterno/delete/{id}', 'PisoInteriorController@delete')->name("pisoInterno.delete");
Route::post('/pisoInterno/store', 'PisoInteriorController@store')->name("pisoInterno.store");
Route::post('/pisoInterno/update', 'PisoInteriorController@update')->name("pisoInterno.update");

//categoria proprietario
Route::get('/catProprietario', 'CategoriaProprietarioController@index')->name("catProprietario.index");
Route::get('/catProprietario/create', 'CategoriaProprietarioController@create')->name("catProprietario.create");
Route::get('/catProprietario/edit/{tipo}/{id}', 'CategoriaProprietarioController@edit')->name("catProprietario.edit");
Route::get('/catProprietario/delete/{id}', 'CategoriaProprietarioController@delete')->name("catProprietario.delete");
Route::post('/catProprietario/store', 'CategoriaProprietarioController@store')->name("catProprietario.store");
Route::post('/catProprietario/update', 'CategoriaProprietarioController@update')->name("catProprietario.update");

//melhorias
Route::get('/melhorias', 'MelhoriasController@index')->name("melhorias.index");
Route::get('/melhorias/create', 'MelhoriasController@create')->name("melhorias.create");
Route::get('/melhorias/edit/{tipo}/{id}', 'MelhoriasController@edit')->name("melhorias.edit");
Route::get('/melhorias/delete/{id}', 'MelhoriasController@delete')->name("melhorias.delete");
Route::post('/melhorias/store', 'MelhoriasController@store')->name("melhorias.store");
Route::post('/melhorias/update', 'MelhoriasController@update')->name("melhorias.update");

//serviços rede eletrica
Route::get('/servicoRedeEletrica', 'ServicoRedeEletricaController@index')->name("servicoRedeEletrica.index");
Route::get('/servicoRedeEletrica/create', 'ServicoRedeEletricaController@create')->name("servicoRedeEletrica.create");
Route::get('/servicoRedeEletrica/edit/{tipo}/{id}', 'ServicoRedeEletricaController@edit')->name("servicoRedeEletrica.edit");
Route::get('/servicoRedeEletrica/delete/{id}', 'ServicoRedeEletricaController@delete')->name("servicoRedeEletrica.delete");
Route::post('/servicoRedeEletrica/store', 'ServicoRedeEletricaController@store')->name("servicoRedeEletrica.store");
Route::post('/servicoRedeEletrica/update', 'ServicoRedeEletricaController@update')->name("servicoRedeEletrica.update");

//serviços esgoto
Route::get('/servicoEsgoto', 'ServicoEsgotoController@index')->name("servicoEsgoto.index");
Route::get('/servicoEsgoto/create', 'ServicoEsgotoController@create')->name("servicoEsgoto.create");
Route::get('/servicoEsgoto/edit/{tipo}/{id}', 'ServicoEsgotoController@edit')->name("servicoEsgoto.edit");
Route::get('/servicoEsgoto/delete/{id}', 'ServicoEsgotoController@delete')->name("servicoEsgoto.delete");
Route::post('/servicoEsgoto/store', 'ServicoEsgotoController@store')->name("servicoEsgoto.store");
Route::post('/servicoEsgoto/update', 'ServicoEsgotoController@update')->name("servicoEsgoto.update");

//número de pavimento
Route::get('/numeroPavimento', 'NumeroPavimentoController@index')->name("numeroPavimento.index");
Route::get('/numeroPavimento/create', 'NumeroPavimentoController@create')->name("numeroPavimento.create");
Route::get('/numeroPavimento /edit/{tipo}/{id}', 'NumeroPavimentoController@edit')->name("numeroPavimento.edit");
Route::get('/numeroPavimento/delete/{id}', 'NumeroPavimentoController@delete')->name("numeroPavimento.delete");
Route::post('/numeroPavimento/store', 'NumeroPavimentoController@store')->name("numeroPavimento.store");
Route::post('/numeroPavimento/update', 'NumeroPavimentoController@update')->name("numeroPavimento.update");

//abastecimento agua
Route::get('/abastecimentoAgua', 'AbastecimentoAguaController@index')->name("abastecimentoAgua.index");
Route::get('/abastecimentoAgua/create', 'AbastecimentoAguaController@create')->name("abastecimentoAgua.create");
Route::get('/abastecimentoAgua/edit/{tipo}/{id}', 'AbastecimentoAguaController@edit')->name("abastecimentoAgua.edit");
Route::get('/abastecimentoAgua/delete/{id}', 'AbastecimentoAguaController@delete')->name("abastecimentoAgua.delete");
Route::post('/abastecimentoAgua/store', 'AbastecimentoAguaController@store')->name("abastecimentoAgua.store");
Route::post('/abastecimentoAgua/update', 'AbastecimentoAguaController@update')->name("abastecimentoAgua.update");

//forro
Route::get("/forro", "ForroController@index")->name("indexForro");
Route::get("/forro/create", "ForroController@create")->name("createForro");
Route::get("/forro/edit/{id}", "ForroController@edit")->name("editForro");
Route::post("/forro/store", "ForroController@store")->name("storeForro");
Route::put("/forro/update/{id}", "ForroController@update")->name("updateForro");
Route::delete("/forro/delete/{id}", "ForroController@delete")->name("deleteForro");

//esquadria porta
Route::get("/esquadria-porta", "EsquadriaPortaController@index")->name("indexEsquadriaPorta");
Route::get("/esquadria-porta/create", "EsquadriaPortaController@create")->name("createEsquadriaPorta");
Route::get("/esquadria-porta/edit/{id}", "EsquadriaPortaController@edit")->name("editEsquadriaPorta");
Route::post("/esquadria-porta/store", "EsquadriaPortaController@store")->name("storeEsquadriaPorta");
Route::put("/esquadria-porta/update/{id}", "EsquadriaPortaController@update")->name("updateEsquadriaPorta");
Route::delete("/esquadria-porta/delete/{id}", "EsquadriaPortaController@delete")->name("deleteEsquadriaPorta");

//esquadria janela
Route::get("/esquadria-janela", "EsquadriaJanelaController@index")->name("indexEsquadriaJanela");
Route::get("/esquadria-janela/create", "EsquadriaJanelaController@create")->name("createEsquadriaJanela");
Route::get("/esquadria-janela/edit/{id}", "EsquadriaJanelaController@edit")->name("editEsquadriaJanela");
Route::post("/esquadria-janela/store", "EsquadriaJanelaController@store")->name("storeEsquadriaJanela");
Route::put("/esquadria-janela/update/{id}", "EsquadriaJanelaController@update")->name("updateEsquadriaJanela");
Route::delete("/esquadria-janela/delete/{id}", "EsquadriaJanelaController@delete")->name("deleteEsquadriaJanela");

//pintura esquadria
Route::get("/pintura-esquadria", "PinturaEsquadriaController@index")->name("indexPinturaEsquadria");
Route::get("/pintura-esquadria/create", "PinturaEsquadriaController@create")->name("createPinturaEsquadria");
Route::get("/pintura-esquadria/edit/{id}", "PinturaEsquadriaController@edit")->name("editPinturaEsquadria");
Route::post("/pintura-esquadria/store", "PinturaEsquadriaController@store")->name("storePinturaEsquadria");
Route::put("/pintura-esquadria/update/{id}", "PinturaEsquadriaController@update")->name("updatePinturaEsquadria");
Route::delete("/pintura-esquadria/delete/{id}", "PinturaEsquadriaController@delete")->name("deletePinturaEsquadria");

//instalacao eletrica
Route::get("/instalacao-eletrica", "InstalEletricaController@index")->name("indexInstalEletrica");
Route::get("/instalacao-eletrica/create", "InstalEletricaController@create")->name("createInstalEletrica");
Route::get("/instalacao-eletrica/edit/{id}", "InstalEletricaController@edit")->name("editInstalEletrica");
Route::post("/instalacao-eletrica/store", "InstalEletricaController@store")->name("storeInstalEletrica");
Route::put("/instalacao-eletrica/update/{id}", "InstalEletricaController@update")->name("updateInstalEletrica");
Route::delete("/instalacao-eletrica/delete/{id}", "InstalEletricaController@delete")->name("deleteInstalEletrica");

//instalacao sanitaria
Route::get("/instalacao-sanitaria", "InstalSanitariaController@index")->name("indexInstalSanitaria");
Route::get("/instalacao-sanitaria/create", "InstalSanitariaController@create")->name("createInstalSanitaria");
Route::get("/instalacao-sanitaria/edit/{id}", "InstalSanitariaController@edit")->name("editInstalSanitaria");
Route::post("/instalacao-sanitaria/store", "InstalSanitariaController@store")->name("storeInstalSanitaria");
Route::put("/instalacao-sanitaria/update/{id}", "InstalSanitariaController@update")->name("updateInstalSanitaria");
Route::delete("/instalacao-sanitaria/delete/{id}", "InstalSanitariaController@delete")->name("deleteInstalSanitaria");

//estrutura
Route::get("/estrutura", "EstruturaController@index")->name("indexEstrutura");
Route::get("/estrutura/create", "EstruturaController@create")->name("createEstrutura");
Route::get("/estrutura/edit/{id}", "EstruturaController@edit")->name("editEstrutura");
Route::post("/estrutura/store", "EstruturaController@store")->name("storeEstrutura");
Route::put("/estrutura/update/{id}", "EstruturaController@update")->name("updateEstrutura");
Route::delete("/estrutura/delete/{id}", "EstruturaController@delete")->name("deleteEstrutura");

//estrutura telhado
Route::get("/estrutura-telhado", "EstruturaTelhadoController@index")->name("indexEstruturaTelhado");
Route::get("/estrutura-telhado/create", "EstruturaTelhadoController@create")->name("createEstruturaTelhado");
Route::get("/estrutura-telhado/edit/{id}", "EstruturaTelhadoController@edit")->name("editEstruturaTelhado");
Route::post("/estrutura-telhado/store", "EstruturaTelhadoController@store")->name("storeEstruturaTelhado");
Route::put("/estrutura-telhado/update/{id}", "EstruturaTelhadoController@update")->name("updateEstruturaTelhado");
Route::delete("/estrutura-telhado/delete/{id}", "EstruturaTelhadoController@delete")->name("deleteEstruturaTelhado");

//cobertura
Route::get("/cobertura", "CoberturaController@index")->name("indexCobertura");
Route::get("/cobertura/create", "CoberturaController@create")->name("createCobertura");
Route::get("/cobertura/edit/{id}", "CoberturaController@edit")->name("editCobertura");
Route::post("/cobertura/store", "CoberturaController@store")->name("storeCobertura");
Route::put("/cobertura/update/{id}", "CoberturaController@update")->name("updateCobertura");
Route::delete("/cobertura/delete/{id}", "CoberturaController@delete")->name("deleteCobertura");

//elevador
Route::get("/elevador", "ElevadorController@index")->name("indexElevador");
Route::get("/elevador/create", "ElevadorController@create")->name("createElevador");
Route::get("/elevador/edit/{id}", "ElevadorController@edit")->name("editElevador");
Route::post("/elevador/store", "ElevadorController@store")->name("storeElevador");
Route::put("/elevador/update/{id}", "ElevadorController@update")->name("updateElevador");
Route::delete("/elevador/delete/{id}", "ElevadorController@delete")->name("deleteElevador");

//situacao construcao
Route::get("/situacao-construcao", "SituacaoConstrucaoController@index")->name("indexSituacaoConstrucao");
Route::get("/situacao-construcao/create", "SituacaoConstrucaoController@create")->name("createSituacaoConstrucao");
Route::get("/situacao-construcao/edit/{id}", "SituacaoConstrucaoController@edit")->name("editSituacaoConstrucao");
Route::post("/situacao-construcao/store", "SituacaoConstrucaoController@store")->name("storeSituacaoConstrucao");
Route::put("/situacao-construcao/update/{id}", "SituacaoConstrucaoController@update")->name("updateSituacaoConstrucao");
Route::delete("/situacao-construcao/delete/{id}", "SituacaoConstrucaoController@delete")->name("deleteSituacaoConstrucao");

//localizacao vertical
Route::get("/localizacao-vertical", "LocalizacaoVerticalController@index")->name("indexLocalizacaoVertical");
Route::get("/localizacao-vertical/create", "LocalizacaoVerticalController@create")->name("createLocalizacaoVertical");
Route::get("/localizacao-vertical/edit/{id}", "LocalizacaoVerticalController@edit")->name("editLocalizacaoVertical");
Route::post("/localizacao-vertical/store", "LocalizacaoVerticalController@store")->name("storeLocalizacaoVertical");
Route::put("/localizacao-vertical/update/{id}", "LocalizacaoVerticalController@update")->name("updateLocalizacaoVertical");
Route::delete("/localizacao-vertical/delete/{id}", "LocalizacaoVerticalController@delete")->name("deleteLocalizacaoVertical");

//acabamento
Route::get("/acabamento", "AcabamentoController@index")->name("indexAcabamento");
Route::get("/acabamento/create", "AcabamentoController@create")->name("createAcabamento");
Route::get("/acabamento/edit/{id}", "AcabamentoController@edit")->name("editAcabamento");
Route::post("/acabamento/store", "AcabamentoController@store")->name("storeAcabamento");
Route::put("/acabamento/update/{id}", "AcabamentoController@update")->name("updateAcabamento");
Route::delete("/acabamento/delete/{id}", "AcabamentoController@delete")->name("deleteAcabamento");

//casa alinhada
Route::get("/casa-alinhada", "CasaAlinhadaController@index")->name("indexCasaAlinhada");
Route::get("/casa-alinhada/create", "CasaAlinhadaController@create")->name("createCasaAlinhada");
Route::get("/casa-alinhada/edit/{id}", "CasaAlinhadaController@edit")->name("editCasaAlinhada");
Route::post("/casa-alinhada/store", "CasaAlinhadaController@store")->name("storeCasaAlinhada");
Route::put("/casa-alinhada/update/{id}", "CasaAlinhadaController@update")->name("updateCasaAlinhada");
Route::delete("/casa-alinhada/delete/{id}", "CasaAlinhadaController@delete")->name("deleteCasaAlinhada");

//casa recuada
Route::get("/casa-recuada", "CasaRecuadaController@index")->name("indexCasaRecuada");
Route::get("/casa-recuada/create", "CasaRecuadaController@create")->name("createCasaRecuada");
Route::get("/casa-recuada/edit/{id}", "CasaRecuadaController@edit")->name("editCasaRecuada");
Route::post("/casa-recuada/store", "CasaRecuadaController@store")->name("storeCasaRecuada");
Route::put("/casa-recuada/update/{id}", "CasaRecuadaController@update")->name("updateCasaRecuada");
Route::delete("/casa-recuada/delete/{id}", "CasaRecuadaController@delete")->name("deleteCasaRecuada");

//escritorio
Route::get("/escritorio", "EscritorioController@index")->name("indexEscritorio");
Route::get("/escritorio/create", "EscritorioController@create")->name("createEscritorio");
Route::get("/escritorio/edit/{id}", "EscritorioController@edit")->name("editEscritorio");
Route::post("/escritorio/store", "EscritorioController@store")->name("storeEscritorio");
Route::put("/escritorio/update/{id}", "EscritorioController@update")->name("updateEscritorio");
Route::delete("/escritorio/delete/{id}", "EscritorioController@delete")->name("deleteEscritorio");

//comercio
Route::get("/comercio", "ComercioController@index")->name("indexComercio");
Route::get("/comercio/create", "ComercioController@create")->name("createComercio");
Route::get("/comercio/edit/{id}", "ComercioController@edit")->name("editComercio");
Route::post("/comercio/store", "ComercioController@store")->name("storeComercio");
Route::put("/comercio/update/{id}", "ComercioController@update")->name("updateComercio");
Route::delete("/comercio/delete/{id}", "ComercioController@delete")->name("deleteComercio");

//estado conservacao
Route::get("/estado-conservacao", "EstadoConservacaoController@index")->name("indexEstadoConservacao");
Route::get("/estado-conservacao/create", "EstadoConservacaoController@create")->name("createEstadoConservacao");
Route::get("/estado-conservacao/edit/{id}", "EstadoConservacaoController@edit")->name("editEstadoConservacao");
Route::post("/estado-conservacao/store", "EstadoConservacaoController@store")->name("storeEstadoConservacao");
Route::put("/estado-conservacao/update/{id}", "EstadoConservacaoController@update")->name("updateEstadoConservacao");
Route::delete("/estado-conservacao/delete/{id}", "EstadoConservacaoController@delete")->name("deleteEstadoConservacao");

//categoria
Route::get("/categoria", "CategoriaController@index")->name("indexCategoria");
Route::get("/categoria/create", "CategoriaController@create")->name("createCategoria");
Route::get("/categoria/edit/{id}", "CategoriaController@edit")->name("editCategoria");
Route::post("/categoria/store", "CategoriaController@store")->name("storeCategoria");
Route::put("/categoria/update/{id}", "CategoriaController@update")->name("updateCategoria");
Route::delete("/categoria/delete/{id}", "CategoriaController@delete")->name("deleteCategoria");

//forma terreno
Route::get("/forma-terreno", "FormaTerrenoController@index")->name("indexFormaTerreno");
Route::get("/forma-terreno/create", "FormaTerrenoController@create")->name("createFormaTerreno");
Route::get("/forma-terreno/edit/{id}", "FormaTerrenoController@edit")->name("editFormaTerreno");
Route::post("/forma-terreno/store", "FormaTerrenoController@store")->name("storeFormaTerreno");
Route::put("/forma-terreno/update/{id}", "FormaTerrenoController@update")->name("updateFormaTerreno");
Route::delete("/forma-terreno/delete/{id}", "FormaTerrenoController@delete")->name("deleteFormaTerreno");

//situacao terreno
Route::get("/situacao-terreno", "SituacaoTerrenoController@index")->name("indexSituacaoTerreno");
Route::get("/situacao-terreno/create", "SituacaoTerrenoController@create")->name("createSituacaoTerreno");
Route::get("/situacao-terreno/edit/{id}", "SituacaoTerrenoController@edit")->name("editSituacaoTerreno");
Route::post("/situacao-terreno/store", "SituacaoTerrenoController@store")->name("storeSituacaoTerreno");
Route::put("/situacao-terreno/update/{id}", "SituacaoTerrenoController@update")->name("updateSituacaoTerreno");
Route::delete("/situacao-terreno/delete/{id}", "SituacaoTerrenoController@delete")->name("deleteSituacaoTerreno");

//uso terreno
Route::get("/uso-terreno", "UsoTerrenoController@index")->name("indexUsoTerreno");
Route::get("/uso-terreno/create", "UsoTerrenoController@create")->name("createUsoTerreno");
Route::get("/uso-terreno/edit/{id}", "UsoTerrenoController@edit")->name("editUsoTerreno");
Route::post("/uso-terreno/store", "UsoTerrenoController@store")->name("storeUsoTerreno");
Route::put("/uso-terreno/update/{id}", "UsoTerrenoController@update")->name("updateUsoTerreno");
Route::delete("/uso-terreno/delete/{id}", "UsoTerrenoController@delete")->name("deleteUsoTerreno");

//protecao calcada
Route::get("/protecao-calcada", "ProtecaoCalcadaController@index")->name("indexProtecaoCalcada");
Route::get("/protecao-calcada/create", "ProtecaoCalcadaController@create")->name("createProtecaoCalcada");
Route::get("/protecao-calcada/edit/{id}", "ProtecaoCalcadaController@edit")->name("editProtecaoCalcada");
Route::post("/protecao-calcada/store", "ProtecaoCalcadaController@store")->name("storeProtecaoCalcada");
Route::put("/protecao-calcada/update/{id}", "ProtecaoCalcadaController@update")->name("updateProtecaoCalcada");
Route::delete("/protecao-calcada/delete/{id}", "ProtecaoCalcadaController@delete")->name("deleteProtecaoCalcada");

//pedologia terreno
Route::get("/pedologia-terreno", "PedologiaTerrenoController@index")->name("indexPedologiaTerreno");
Route::get("/pedologia-terreno/create", "PedologiaTerrenoController@create")->name("createPedologiaTerreno");
Route::get("/pedologia-terreno/edit/{id}", "PedologiaTerrenoController@edit")->name("editPedologiaTerreno");
Route::post("/pedologia-terreno/store", "PedologiaTerrenoController@store")->name("storePedologiaTerreno");
Route::put("/pedologia-terreno/update/{id}", "PedologiaTerrenoController@update")->name("updatePedologiaTerreno");
Route::delete("/pedologia-terreno/delete/{id}", "PedologiaTerrenoController@delete")->name("deletePedologiaTerreno");

//topografia terreno
Route::get("/topografia-terreno", "TopografiaTerrenoController@index")->name("indexTopografiaTerreno");
Route::get("/topografia-terreno/create", "TopografiaTerrenoController@create")->name("createTopografiaTerreno");
Route::get("/topografia-terreno/edit/{id}", "TopografiaTerrenoController@edit")->name("editTopografiaTerreno");
Route::post("/topografia-terreno/store", "TopografiaTerrenoController@store")->name("storeTopografiaTerreno");
Route::put("/topografia-terreno/update/{id}", "TopografiaTerrenoController@update")->name("updateTopografiaTerreno");
Route::delete("/topografia-terreno/delete/{id}", "TopografiaTerrenoController@delete")->name("deleteTopografiaTerreno");

//Vistoria de Obras
Route::get('/vistoria-obras', 'VistoriaObrasController@index')->name('indexVistoriaObras');
Route::get('/vistoria-obras/details/{id}', 'VistoriaObrasController@details')->name('detailsVistoriaObras');

//obras publicas
Route::get("/status-obras-publicas", "ObraPublicaStatusController@index")->name("indexObraPublicaStatus");
Route::get("/status-obras-publicas/create", "ObraPublicaStatusController@create")->name("createObraPublicaStatus");
Route::get("/status-obras-publicas/edit/{id}", "ObraPublicaStatusController@edit")->name("editObraPublicaStatus");
Route::post("/status-obras-publicas/store", "ObraPublicaStatusController@store")->name("storeObraPublicaStatus");
Route::put("/status-obras-publicas/update/{id}", "ObraPublicaStatusController@update")->name("updateObraPublicaStatus");

Route::get('/solicitacao-poda-supressao', 'SolicitacaoPodaRetiradaController@index')->name('indexSolicitacoesPodaRetirada');
Route::get('/detalhes-solicitacao-poda-supressao/{id}', 'SolicitacaoPodaRetiradaController@details')->name('detailsSolicitacaoPodaRetirada');

Route::get('/relatoriodocdig', 'RelDocDigitalizadosController@index')->name('indexRelDocDigitalizados');
Route::get('/relatoriodocdig/gerar', 'RelDocDigitalizadosController@gerar')->name('gerarRelDocDigitalizados');
Route::get('/relatoriodocdig/getSecretarias', 'RelDocDigitalizadosController@getSecretarias')->name('getSecretariasRelDocDigitalizados');
Route::get('/relatoriodocdig/getNomeObservacao', 'RelDocDigitalizadosController@getNomeObservacao')->name('getNomeObservacaoRelDocDigitalizados');


Route::get('/setCompAbastecimento','AbastecimentoController@setCompAbastecimento')->name('setCompAbastecimento');

Route::get('/alterarStatusCacamba', 'CacambaController@alterarStatus')->name('alterarStatus');

Route::get('/material', 'MaterialController@index')->name("indexMaterial");
Route::get("/material/create", "MaterialController@create")->name("createMaterial");
Route::get("/material/edit/{id}", "MaterialController@edit")->name("editMaterial");
Route::post("/material/store", "MaterialController@store")->name("storeMaterial");
Route::put("/material/update/{id}", "MaterialController@update")->name("updateMaterial");
Route::delete("/material/delete/{id}", "MaterialController@destroy")->name("deleteMaterial");
Route::get("/material/show/{id}", "MaterialController@show")->name("detailsMaterial");

Route::resource('controleTrafego','ControleTrafegoController');
