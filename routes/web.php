
<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\ClearFromAttributes;
use App\Http\Middleware\facebookRedirect;
use App\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

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
//test index
Route::post('postRegister','loginController@postRegister');
Route::get('/checkout','homeController@checkout');
Route::get('/home','homeController@home' );
Route::get('/contact','homeController@contact' );
//lo5c
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('/postLoc', 'UserCartcontroller@loc');
//search
route::match(['GET','POST'],'/checkValidate','loginController@checkValidate');
Route::get('/livesearch', 'UserCartcontroller@livesearch');

Route::get('/search','homeController@search' )->middleware(ClearFromAttributes::class);
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
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('admin/product/postCreate', 'AdminProductController@postCreate');
Route::get('admin/product/delete', 'AdminProductController@delete');
Route::get('admin/product/update/{id}', 'AdminProductController@update');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
route::post('admin/product/postUpdate/{id}', 'AdminProductController@postUpdate');
//Contact User Admin
Route::get('admin/contact_user/index', 'AdminContactUserController@index');
Route::get('admin/contact_user/delete', 'AdminContactUserController@delete');

//comment admin
Route::get('admin/comment/index', 'AdminCommentController@index');
Route::get('admin/comment/delete', 'AdminCommentController@delete');
//Order Admin
Route::get('admin/order/index', 'AdminOrderController@index');
route::get('admin/order/view/{id}', 'AdminOrderController@view');

Route::get('admin/order/edit', 'AdminOrderController@edit');

Route::get('admin/order/update/{id}', 'AdminOrderController@update');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('admin/order/postUpdate/{id}', 'AdminOrderController@postUpdate');

Route::get('admin/category/update/{id}', 'AdminCategoryController@update');
Route::get('admin/category/delete', 'AdminCategoryController@delete');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('admin/category/postUpdate/{id}', 'AdminCategoryController@postUpdate');
//Role Admin
Route::get('admin/role/index', 'Adminrolecontroller@index');
Route::get('admin/role/create', 'Adminrolecontroller@create');
Route::get('admin/role/delete/', 'Adminrolecontroller@delete');
Route::get('admin/role/update/{id}', 'Adminrolecontroller@update');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
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



if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('/postLoginCheckOut', 'loginController@postLoginCheckOut');
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('/postRegisterCheckOut', 'loginController@postRegisterCheckOut');

//Route::get('/cart/{id}','Admincontroller@addCart' );



if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('/postDiaChiCheckOut', 'UserCartcontroller@postDiaChiCheckOut');



if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('/postDetailProduct', 'AdminProductController@postDetailProduct');
Route::get('product/{slug}','homeController@product')->middleware(ClearFromAttributes::class);

//Route::get('product/{slug}','homeController@product')->middleware(ClearFromAttributes::class);

Route::get('/product','homeController@allproduct')->middleware(ClearFromAttributes::class);
Route::get('/auth/{provider}', 'SocialAuthController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'SocialAuthController@handleProviderCallback');

Route::view('/money', 'money');
Route::view('/ship-home', 'ship_home');
Route::view('/ship', 'ship');
Route::view('/warranty', 'warranty');
Route::view('/deposit', 'deposit');
Route::view('/news', 'news');
Route::view('/admin/laptopshop', 'admin.laptopshop');
//coment 
if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST')
Route::post('comment/{id}','CommentController@postComment');

route::get('dynamic_pdf/{id}/pdf','DynamicPDFController@pdf');
route::get('myorder/history','UserCartcontroller@history');
route::get('myorder/view/{id}','UserCartcontroller@historyview');