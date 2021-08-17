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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'mahasiswa'], function() {
    Route::get('/', 'MahasiswaController@index')->name('mahasiswa');
    Route::get('create', 'MahasiswaController@create')->name('mahasiswa.create');
    Route::get('get', 'MahasiswaController@get')->name('mahasiswa.get');
    Route::post('store', 'MahasiswaController@store')->name('mahasiswa.store');
    Route::get('edit/{id?}', 'MahasiswaController@edit')->name('mahasiswa.edit');
    Route::get('view/{id?}', 'MahasiswaController@view')->name('mahasiswa.view');
    Route::get('delete/{id?}', 'MahasiswaController@delete')->name('mahasiswa.delete');
    Route::post('update/{id?}', 'MahasiswaController@update')->name('mahasiswa.update');
});
