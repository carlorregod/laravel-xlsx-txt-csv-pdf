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
