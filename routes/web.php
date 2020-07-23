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
//forn end
Route::get('/home','homeController@index' );

Route::get('/contact','homeController@contact' );

Route::get('/product','homeController@product' );

Route::get('/login','homeController@login' );





