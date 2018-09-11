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

Route::get('runner/inscripciones/create/{id}', ['as'=>'runner.inscripciones.create','uses'=>'InscripcionController@create']);
Route::get('runner/inscripciones', ['as'=>'runner.inscripciones.index','uses'=>'InscripcionController@index']);
Route::post('runner/inscripciones', ['as'=>'runner.inscripciones.store','uses'=>'InscripcionController@store']);
Route::get('runner/inscripciones/{id}/edit', ['as'=>'runner.inscripciones.edit','uses'=>'InscripcionController@edit']);
Route::delete('runner/inscripciones/{id}', ['as'=>'runner.inscripciones.destroy','uses'=>'InscripcionController@destroy']);
Route::get('runner/inscripciones/excelChip', ['as'=>'runner.inscripciones.excelChip','uses'=>'InscripcionController@inscripcionesExcelChip']);
Route::get('runner/inscripciones/excel', ['as'=>'runner.inscripciones.excel','uses'=>'InscripcionController@inscripcionesExcel']);
Route::get('runner/inscripciones/pdf', ['as'=>'runner.inscripciones.pdf','uses'=>'InscripcionController@inscripcionesPDF']);
Route::put('runner/inscripciones/{id}', ['as'=>'runner.inscripciones.update','uses'=>'InscripcionController@update']);
Route::get('runner/inscripciones/kit', ['as'=>'runner.inscripciones.kit','uses'=>'InscripcionController@kits']);
Route::get('runner/inscripciones/entregarKit/{id}', ['as'=>'runner.inscripciones.entregarKit','uses'=>'InscripcionController@entregarkit']);

Route::get('runner/comprobantes/reportes/pdf/{id}', ['as'=>'runner.comprobantes.pdf','uses'=>'ComprobanteController@pagoPDF']);
Route::get('runner/comprobantes/cuadre', ['as'=>'runner.comprobantes.cuadre','uses'=>'ComprobanteController@cuadre']);
Route::get('runner/comprobantes/excel', ['as'=>'runner.comprobantes.excel','uses'=>'ComprobanteController@comprobantesExcel']);

//Restaurar usuarios
Route::get('runner/usuarios/restore', ['as'=>'runner.usuarios.getrestore','uses'=>'UsuarioController@getRestore']);
Route::get('runner/usuarios/{id}/restore', ['as'=>'runner.usuarios.postrestore','uses'=>'UsuarioController@postRestore']);

//Route::get('runner/importar/personas/', ['as'=>'runner.importar.personas','uses'=>'ImportarPersonasController@index']);
//Route::get('runner/importar/personas/imp', ['as'=>'runner.importar.personas.imp','uses'=>'ImportarPersonasController@imp']);
//Route::get('runner/usuarios/profile/{id}/editProfile', ['as'=>'runner.profile.edit','uses'=>'UsuarioController@editProfile']);
//Route::put('runner/usuarios/profile/{id}', ['as'=>'runner.profile.updateProfile','uses'=>'UsuarioController@updateProfile']);

//muestra el stock de las tallas
Route::get('runner/tallas/getstock', ['as'=>'runner.tallas.getStock','uses'=>'TallaController@getTallaStock']);

Route::resource('runner/personas', 'PersonaController');
Route::resource('runner/categorias', 'CategoriaController',['except'=>['show']]);
Route::resource('runner/circuitos', 'CircuitoController',['except'=>['show']]);
Route::resource('runner/escenarios', 'EscenarioController',['except'=>['show']]);
Route::resource('runner/usuarios', 'UsuarioController' );
Route::resource('runner/roles', 'RolesController' );
Route::resource('runner/pagos', 'ComprobanteController' );
Route::resource('runner/deportes', 'DeporteController',['except'=>['show']]);
Route::resource('runner/tallas', 'TallaController',['except'=>['show']]);

//Route::resource('runner/importar/personas', 'ImportarPersonasController');

//Exportar a excell
//Route::resource('export/excel','ExcelController');

//importar chips de excel y vaciar la tabla de chips
Route::get('runner/importChip', ['as'=>'chips.import','uses'=>'ChipsController@getChip']);
Route::post('runner/importChip', ['as'=>'chips.store','uses'=>'ChipsController@postChip']);
Route::get('runner/truncateChip', ['as'=>'chips.truncate','uses'=>'ChipsController@truncateChip']);


//Auth login
Route::auth();
Route::get('/home', ['uses'=>'HomeController@index', 'as'=>'home']);


//Inscripcion ONLINE
Route::get('/online', function () {
        return view('runner/personas/importar/createOnline');
});
Route::post('/online', ['as'=>'runner.personas.importar.createOnline','uses'=>'PersonaOnlineController@store']);

//Resultados 2016
Route::get('/result/import', ['as'=>'result.import','uses'=>'ResultsController@getResult']);
Route::get('/result/truncate', ['as'=>'result.truncate','uses'=>'ResultsController@truncate']);
Route::get('/result/pdf/{id}', ['as'=>'result.diploma','uses'=>'ResultsController@diploma']);
Route::get('/result/diploma/{id}',['uses'=> 'ResultsController@getDiploma','as'=>'diploma']);
//Datatable-Laravel
//Route::controller('/api/result', 'ResultsController', [
//    'anyData'  => 'result.data',
//    'getIndex' => 'datatables',
//]);

Route::resource('/result','ResultsController');

//Configuracion
Route::get('runner/config', ['as'=>'runner.config.index','uses'=>'ConfigController@index']);
Route::post('runner/config', ['as'=>'runner.config.cierre','uses'=>'ConfigController@postCierre']);



//Charts
Route::get('estadisticas/categorias', ['as'=>'runner.charts.categorias','uses'=>'EstadisticaController@categorias']);
Route::get('estadisticas/circuitos', ['as'=>'runner.charts.circuitos','uses'=>'EstadisticaController@circuitos']);
Route::get('estadisticas/generos', ['as'=>'runner.charts.generos','uses'=>'EstadisticaController@generos']);
Route::get('estadisticas/cat_cir', ['as'=>'runner.charts.cat_cir','uses'=>'EstadisticaController@cat_cir']);
