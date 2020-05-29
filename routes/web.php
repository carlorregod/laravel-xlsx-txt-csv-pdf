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

Route::get('/leyendocsv','ProductController@lectura_csv')->name('leeCsv');
Route::get('/generaxlsx','ProductController@generar_xlsx')->name('escribeXlsx');
Route::get('/descargarpdf', 'ProductController@pdf')->name('productos.pdf');
Route::get('/descargarpdf2', 'ProductController@pdf2')->name('productos2.pdf');
//Subir un archivo al server, la página
Route::get('/uploadfile', 'ProductController@page_upload_file')->name('pagina-subirArchivo');
//El método
Route::post('/upload_file', 'ProductController@upload_file')->name('subiendoArchivo');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Para buscar un archivo en el servidor y descargarlo:
Route::get('storage/{archivo}', function ($archivo) {
    $public_path = public_path();
    $url = $public_path.'/storage/'.$archivo;
    //verificamos si el archivo existe y lo retornamos
    if (Storage::exists($archivo))
    {
      return response()->download($url);
    }
    //si no se encuentra lanzamos un error 404.
    abort(404);

});