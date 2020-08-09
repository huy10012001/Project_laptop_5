
<?php

use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
Route::get('/checkout','homeController@checkout');
Route::get('/home','homeController@home' );
Route::get('/contact','homeController@contact' );
Route::get('product/{name}','homeController@product');
//trang test gio hang(khong nam trong do an)
Route::get('/cart', 'UserCartcontroller@cart');
Route::get('/index', 'homeController@index');
//category Admin
Route::get('admin/category/index', 'AdminCategoryController@index');
Route::get('admin/category/create', 'AdminCategoryController@create');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('admin/category/postCreate', 'AdminCategoryController@postCreate');
Route::get('admin/category/update/{id}', 'AdminCategoryController@update');
Route::get('admin/category/delete', 'AdminCategoryController@delete');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('admin/category/postUpdate/{id}', 'AdminCategoryController@postUpdate');
//Product Admin
Route::get('admin/product/detail/{id}', 'AdminProductController@DetailProduct');
Route::get('admin/product/index', 'AdminProductController@index');
Route::get('admin/product/create', 'AdminProductController@create');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST');
Route::post('admin/product/postCreate', 'AdminProductController@postCreate');
Route::get('admin/product/delete', 'AdminProductController@delete');
Route::get('admin/product/update/{id}', 'AdminProductController@update');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
route::post('admin/product/postUpdate/{id}', 'AdminProductController@postUpdate');
//Contact User Admin
Route::get('admin/contact_user/index', 'AdminContactUserController@index');
Route::get('admin/contact_user/delete', 'AdminContactUserController@delete');
//Order Admin
Route::get('admin/order/index', 'AdminOrderController@index');
route::get('admin/order/view/{id}', 'AdminOrderController@view');
Route::get('admin/order/delete', 'AdminOrderController@delete');
Route::get('admin/order/update/{id}', 'AdminOrderController@update');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
route::post('admin/order/postUpdate/{id}', 'AdminOrderController@postUpdate');
//Role Admin
Route::get('admin/role/index', 'Adminrolecontroller@index');
Route::get('admin/role/create', 'Adminrolecontroller@create');
Route::get('admin/role/delete/', 'Adminrolecontroller@delete');
Route::get('admin/role/update/{id}', 'Adminrolecontroller@update');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST');
Route::post('admin/role/postCreate', 'Adminrolecontroller@postCreate');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
route::post('admin/role/postUpdate/{id}', 'Adminrolecontroller@postUpdate');    
//User Amin
Route::get('admin/user/index', 'Adminusercontroller@index');
Route::get('admin/user/viewRole/{id}', 'Adminusercontroller@update');

if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
route::post('admin/user/postUpdate/{id}', 'Adminusercontroller@postUpdate');
//role cua user
Route::get('admin/user/updateRole/{user_id}/{role_id}', 'Adminusercontroller@updateRole');
Route::get('admin/user/deleteRole', 'Adminusercontroller@deleteRole');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('admin/user/addRole', 'Adminusercontroller@addRole');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('admin/user/postAddRole/{id}', 'Adminusercontroller@postAddRole');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
route::post('admin/user/postUpdateRole/{user_id}/{role_id}', 'Adminusercontroller@postUpdateROLE');
// User thao tac gio hang
Route::get('/cart/update','UserCartcontroller@getUpdateCart');
Route::get('cart/delete/', 'UserCartcontroller@delete');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('/order','UserCartcontroller@order' );
Route::get('/Addcart','UserCartcontroller@addCart' );
//User contact

if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('postContact', 'homeController@postContact');
//login
Route::get('/login','loginController@index' );
Route::get('/logout','loginController@logout' );
//Order
Route::get('/getOrder','UserCartcontroller@getOrder' );
Route::get('/order', 'homeController@order' );
Route::get('/isDangNhap','loginController@checkDangNhap');
//detail
Route::get('/detail','homeController@detail');

if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('/postLogin', 'loginController@postLogin');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('/postLoginCheckOut', 'loginController@postLoginCheckOut');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('/postRegisterCheckOut', 'loginController@postRegisterCheckOut');
;
//Route::get('/cart/{id}','Admincontroller@addCart' );



if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('/postDiaChiCheckOut', 'UserCartcontroller@postDiaChiCheckOut');



if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('/postDetailProduct', 'AdminProductController@postDetailProduct');





