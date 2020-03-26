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
Route::get('/index','IndexController@index');

// Route::get('/add',function(){
//     echo "<form action='/adddo' method='post'>".csrf_field()."<input type='text' name='name'><button>提交</button></form>";
// });
// Route::post('/adddo',function(){
//     echo request()->name;
// });
Route::get('/add','IndexController@add');
Route::post('/adddo','IndexController@adddo');

//一个路由支持多种请求方式
//Route::match(['get','post'],'/add','IndexController@add');
//Route::any('/add','IndexController@add');

//路由视图
// Route::view('/add','add');
// Route::get('/add','IndexController@add');

//必填路由
// Route::get('/show/{id}/{name}',function($id,$name){
//     echo $id."==".$name;
// });

//Route::get('/show/{id}/{name}','IndexController@show');

//可选参数路由
// Route::get('/new/{id}/{name?}',function($id,$name=null){
//     echo $id."==".$name;
// });
//Route::get('/new/{id?}','IndexController@new');

//正则约束
//Route::get('/new/{id?}','IndexController@new')->where('id','[0-9]+');

Route::get('/cart/{id}/{name}','IndexController@cart')->where(['id'=>'\d+','name'=>'[a-zA-Z]']);

//品牌模块
Route::prefix('brand')->middleware('islogin')->group(function(){
    Route::get('create','BrandController@create');
    Route::post('store','BrandController@store');
    Route::get('index','BrandController@index');
    Route::get('edit/{id}','BrandController@edit');
    Route::post('update/{id}','BrandController@update');
    Route::get('destroy/{id}','BrandController@destroy');
});

//登录
Route::get('login','LoginController@login');
Route::post('logindo','LoginController@logindo');
//支付
Route::get('/pay/{orderId}','Index\PayController@pay');
Route::get('/return_url','Index\PayController@return_url');//同步
Route::get('/notify_url','Index\PayController@notify_url');//异步

Route::get('/','Index\IndexController@index');
Route::get('/log','Index\LoginController@log');
Route::get('/reg','Index\LoginController@reg');
Route::get('/reg/sendSMS','Index\LoginController@sendSMS');
Route::get('/reg/sendEmail','Index\LoginController@sendEmail');
Route::post('/dologin','Index\LoginController@dologin');
Route::post('/regs','Index\LoginController@regs');
Route::get('/index/index','Index\LoginController@index');
//商品添加
Route::prefix('goods')->middleware('islogin')->group(function(){
    Route::get('create','GoodsController@create');
    Route::post('store','GoodsController@store')->name('goodsstore');
    Route::get('index','GoodsController@index');
    Route::get('edit/{id}','GoodsController@edit');
    Route::post('update/{id}','GoodsController@update')->name('goodsupdate');
    Route::get('destroy/{id}','GoodsController@destroy');
});

//详情，购物车
Route::get('/pronav/{id}','Index\IndexController@pronav');
Route::get('/prolist','Index\IndexController@prolist');
Route::get('/car/cartlist','Index\IndexController@cartlist');
Route::post('/addcar','Index\IndexController@addcar');
Route::get('/pay','Index\IndexController@pay');
Route::get('/user','Index\IndexController@user');
Route::get('/success/{id}','Index\IndexController@success');
//分类
Route::get('/category/create','CategoryController@create');
Route::post('/category/store','CategoryController@store');
Route::get('/category/index','CategoryController@index');
Route::get('/category/edit/{id}','CategoryController@edit');
Route::post('/category/update/{id}','CategoryController@update');
Route::get('/category/destroy/{id}','CategoryController@destroy');


//用户
Route::prefix('user')->group(function(){
    Route::get('create','UserController@create');
    Route::post('store','UserController@store');
    Route::get('index','UserController@index');
    Route::get('edit/{id}','UserController@edit');
    Route::post('update/{id}','UserController@update');
    Route::get('destroy/{id}','UserController@destroy');
});



//新闻
Route::prefix('news')->group(function(){
    Route::get('create','NewsController@create');
    Route::post('store','NewsController@store');
    Route::get('index','NewsController@index');
});
//售楼
Route::get('/sou/create','SouController@create');
Route::post('/sou/store','SouController@store');
Route::get('/sou/index','SouController@index');
//图书管理
Route::prefix('book')->group(function(){
    Route::get('create','BookController@create');
    Route::post('store','BookController@store');
    Route::get('index','BookController@index');
});
//学生添加
Route::get('/student/create','StudentController@create');
Route::post('/student/store','StudentController@store');
Route::get('/student/index','StudentController@index');
//文章管理
Route::prefix('essay')->middleware('islogin')->group(function(){
    Route::get('create','EssayController@create');
    Route::post('store','EssayController@store');
    Route::get('index','EssayController@index');
    Route::get('edit/{id}','EssayController@edit');
    Route::post('update/{id}','EssayController@update');
    Route::get('destroy/{id}','EssayController@destroy');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
