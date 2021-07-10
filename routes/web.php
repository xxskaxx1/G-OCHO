<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/dashboard', function () {
    //return view('dashboard');
    redirect();
})->middleware(['auth'])->name('dashboard');*/
Route::get('/dashboard','Controller@index')->middleware(['auth'])->name('dashboard');

Route::group(['middleware'=>'auth'],function(){
    Route::post('addUser','Controller@addUser')->name('addUser');
    Route::post('ediUser','Controller@ediUser')->name('ediUser');
    Route::post('delUser','Controller@delUser')->name('delUser');
    Route::post('getUsuario','Controller@getUsuario')->name('getUsuario');
    Route::get('actualiza','Controller@actualiza')->name('actualiza');
});

require __DIR__.'/auth.php';
