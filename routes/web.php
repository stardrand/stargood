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

// Route::get('/', function () {
//     $name="欢迎光临";
//     return view('welcome',['name'=>$name]);
// });


Route::get('/','Index\IndexController@index');  //商店首页
Route::view('/login','index.login');    //登陆页面
Route::post('/login/do','IndexUserController@index');   //执行登陆

Route::get('/email','IndexUserController@sendemail');

Route::prefix('reg')->group(function(){
Route::view('/','index.reg');    //注册页面
Route::post('add','IndexUserController@add');  //手机号ajax
Route::post('sms','IndexUserController@sms'); //短信发送
Route::post('do','IndexUserController@store');
});


//详情页
Route::get('/porinfo/{id}','PorinfoController@edit');    //详情首页
//
Route::get('/porlist/{id}','PorinfoController@show');  //分类展示
Route::post('/cart','CartController@show'); //加入购物车
Route::get('/cartindex','CartController@index'); //购物车展示






//管理库
Route::prefix('guan')->middleware('checklogin')->group(function(){
    Route::get('create','GuanController@create');   //用户添加
    Route::get('createhuo','GuanController@createhuo');   //货物添加
    Route::get('createru','GuanController@createru');   //入库添加
    Route::post('store','GuanController@store');    //用户添加执行
    Route::post('storehuo','GuanController@storehuo');    //货物添加执行
    Route::post('storeru','GuanController@storeru');    //入库添加执行
    Route::get('/','GuanController@index');
    Route::get('edit/{id}','GuanController@edit');      //用户修改
    Route::get('edithuo/{id}','GuanController@edithuo');    //货物修改
    Route::get('editru/{id}','GuanController@editru');      //入库修改
    Route::post('update/{id}','GuanController@update');
    Route::post('updatehuo/{id}','GuanController@updatehuo');
    Route::post('updateru/{id}','GuanController@updateru');

    Route::get('destroy/{id}','GuanController@destroy'); //用户删除
    Route::get('del/{id}','GuanController@del');    //货物删除
    Route::get('dels/{id}','GuanController@dels');  //入库删除
    });

//登陆
Route::view('/reglogin','guan/login');
Route::post('/reglogin/do','GuanController@show');


// Route::get('/setcookie','Index\IndexController@setCookie'); 
// Route::get('/sms','Index\IndexController@sms'); //测试短信发送
// Route::get('/ade', function () {
//     echo "XIXIX";
// });

// Route::get('/add','Tumtit@index');
//         //方法      控制器  控制器的方法
// Route::get('/adds','Tumtit@add');
// Route::post('/asss','Tumtit@asss');

// Route::get('/www', function () {
//     echo encrypt(111111);
// });

Route::get('news','ArticleController@show'); 

/*
//作业
//1
Route::get('/show', function () {
    echo "这里是商品详情页";
});

Route::get('/show2','Tumtit@show');
//2
Route::get('/show/{id}',function($id){
    echo '商品ID是'.$id;
});

//3
Route::get('/show/{id}/{name}',function($id,$name){
    echo '商品ID是:'.$id.',关键字是'.$name;
});

//4
Route::view('/brandadd','user.ass');

Route::get('/brandadd2','Tumtit@adds');
//5*/
// Route::view('/cartadd','user.att');
// Route::post('/aee','Tumtit@aee')->name('haha');


// Route::get('/show/{id}',function($id){
//     echo '商品ID是:'.$id;
// });
// // })->where('id','\d+');

// Route::get('/show/{id}/{name}',function($id,$name){
//     echo '商品ID是:'.$id.',关键字是'.$name;
// })->where(['id'=>'\d+','name'=>'\w+']);



//外来人口表
Route::prefix('pople')->group(function(){
Route::get('create','PeopleController@create');  //添加
Route::post('store','PeopleController@store');   //执行添加
Route::get('/','PeopleController@index');  //展示
Route::get('edit/{id}','PeopleController@edit'); //编辑
Route::post('update/{id}','PeopleController@update');    //执行编辑
Route::get('destroy/{id}','PeopleController@destroy'); //删除
});


//学生成绩表
Route::prefix('student')->group(function(){
Route::get('create','Student@create');
Route::post('store','Student@store');
Route::get('/','Student@index');
Route::get('edit/{id}','Student@edit');
Route::post('update/{id}','Student@update');
Route::get('destroy/{id}','Student@destroy');
});

//品牌
Route::prefix('cartgory')->group(function(){
Route::get('create','CartgoryController@create');
Route::post('store','CartgoryController@store');
Route::get('/','CartgoryController@index');
Route::get('edit/{id}','CartgoryController@edit');
Route::post('update/{id}','CartgoryController@update');
Route::get('destroy/{id}','CartgoryController@destroy');
});
//登陆
// Route::view('/login','login');
// Route::post('/logindo','CheckLoginController@logindo');





//周测1 文章
Route::prefix('article')->middleware('checklogin')->group(function(){
Route::get('create','ArticleController@create');
Route::post('add','ArticleController@add');
Route::post('adds','ArticleController@adds');
Route::post('store','ArticleController@store');
Route::get('/','ArticleController@index');
Route::get('edit/{id}','ArticleController@edit');
Route::post('update/{id}','ArticleController@update');
Route::get('destroy/{id}','ArticleController@destroy'); 
Route::get('del','ArticleController@del'); 
});


//商品分类
Route::prefix('type')->group(function(){
    Route::get('create','TypeController@create');
    Route::post('add','TypeController@add');    //添加aiax验证
    Route::post('store','TypeController@store');
    Route::get('/','TypeController@index');
    Route::get('edit/{id}','TypeController@edit');
    Route::get('show/','TypeController@show');
    Route::post('update/{id}','TypeController@update');
    Route::get('destroy/{id}','TypeController@destroy'); 
    });

//商品
Route::prefix('goods')->group(function(){
    Route::get('create','GoodsController@create');
    Route::post('add','GoodsController@add');    //添加aiax验证
    Route::post('store','GoodsController@store');
    Route::get('/','GoodsController@index');
    Route::get('edit/{id}','GoodsController@edit');
    Route::post('update/{id}','GoodsController@update');
    Route::get('destroy/{id}','GoodsController@destroy'); 
    });

//管理员
Route::prefix('users')->group(function(){
    Route::get('create','UsersController@create');
    Route::post('add','UsersController@add');    //添加aiax验证
    Route::post('store','UsersController@store');
    Route::get('/','UsersController@index');
    Route::get('edit/{id}','UsersController@edit');
    Route::post('update/{id}','UsersController@update');
    Route::get('destroy/{id}','UsersController@destroy'); 
    });