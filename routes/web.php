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
//trang front end
Route::get('/home','homeController@index' );
Route::get('/contact','homeController@contact' );
Route::get('/product/{id}','homeController@product' );
//trang test gio hang(khong nam trong do an)
Route::get('/testcart', 'homeController123@cart');
//category Admin
Route::get('admin/category/index', 'AdminCategoryController@index');
Route::get('admin/category/create', 'AdminCategoryController@create');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('admin/category/postCreate', 'AdminCategoryController@postCreate');
Route::get('admin/category/update/{id}', 'AdminCategoryController@update');
Route::get('admin/category/delete/{id}', 'AdminCategoryController@delete');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('admin/category/postUpdate/{id}', 'AdminCategoryController@postUpdate');
//Product Admin
Route::get('admin/product/index', 'AdminProductController@index');
Route::get('admin/product/create', 'AdminProductController@create');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST');
Route::post('admin/product/postCreate', 'AdminProductController@postCreate');
Route::get('admin/product/delete/{id}', 'AdminProductController@delete');
Route::get('admin/product/update/{id}', 'AdminProductController@update');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
route::post('admin/product/postUpdate/{id}', 'AdminProductController@postUpdate');
//Contact User Admin
Route::get('admin/contact_user/index', 'AdminContactUserController@index');
Route::get('admin/contact_user/delete/{id}', 'AdminContactUserController@delete');
//Order Admin
Route::get('admin/order/index', 'AdminOrderController@index');
route::get('admin/order/view/{id}', 'AdminOrderController@view');
Route::get('admin/order/delete/{id}', 'AdminOrderController@delete');
Route::get('admin/order/update/{id}', 'AdminOrderController@update');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
route::post('admin/order/postUpdate/{id}', 'AdminOrderController@postUpdate');
//Role Admin
Route::get('admin/role/index', 'Adminrolecontroller@index');

Route::get('admin/role/delete/{id}', 'Adminrolecontroller@delete');
Route::get('admin/role/update/{id}', 'Adminrolecontroller@update');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
route::post('admin/role/postUpdate/{id}', 'Adminrolecontroller@postUpdate');
//User Amin
Route::get('admin/user/index', 'Adminusercontroller@index');
Route::get('admin/user/update/{id}', 'Adminusercontroller@update');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
route::post('admin/user/postUpdate/{id}', 'Adminusercontroller@postUpdate');
// User thao tac gio hang
Route::get('/cart/update','UserCartcontroller@getUpdateCart');
Route::get('cart/delete/', 'UserCartcontroller@delete');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('/order','UserCartcontroller@order' );
Route::get('/Addcart','UserCartcontroller@addCart' );

//login
Route::get('/login','loginController@index' );
Route::get('/logout','loginController@logout' );

if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('/postLogin', 'loginController@postLogin');


;
//Route::get('/cart/{id}','Admincontroller@addCart' );











