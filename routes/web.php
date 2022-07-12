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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')
    ->namespace('Admin') 
    ->name('admin.')
    ->prefix('admin') 
    ->group(function () { 
        Route::get('/', 'HomeController@index');
        Route::resource('/restaurants', 'RestaurantController');
        Route::resource('/typologies', 'TypologyController');
        Route::resource('/restaurants/{id}/items', 'ItemController');
        // Route::resource('/restaurants/{$id}/items', 'ItemController');
    });

Route::get("{any?}", function() {
    return view('home');
})->where("any", ".*");
