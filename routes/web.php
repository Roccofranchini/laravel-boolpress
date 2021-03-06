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


Auth::routes(['register' => false]);

// ROTTE CHE NECESSITANO AUTENTICAZIONE

Route::middleware('auth')->name('admin.')->prefix('admin')->namespace('Admin')->group(function(){
    //Rotte protette
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('posts', 'PostController');
    Route::resource('categories', 'CategoryController');
});


//gESTIAMO LE ROTTE CHE NON SONO DI AUTH NE DI ADMIN

Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');
