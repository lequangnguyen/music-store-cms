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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/login', 'Admin\AuthController@getLoginAdmin');
Route::get('/logout', 'Admin\AuthController@getLogoutAdmin')->name('logout');
Route::post('/login', 'Admin\AuthController@postLoginAdmin');
Route::group(['namespace' => 'Admin',
//    'prefix' => 'admin',
    'as'=>'Admin::',
    'middleware' => 'adminLogin'], function () {
    Route::group(['as'=>'dashboard@'], function () {
        Route::get('/',['as'=>'index','uses'=>'DashboardController@index']);
    });
    Route::group(['prefix' => 'user','as'=>'user@'], function () {
        Route::get('/',['as'=>'index','uses'=>'UserController@index'] );
        Route::get('add',['as'=>'add','uses'=> 'UserController@getAdd']);
        Route::post('store',['as'=>'store','uses'=> 'UserController@store'] );
        Route::get('edit/{id}',['as'=>'edit','uses'=>'UserController@getEdit'] );
        Route::get('delete/{id}', ['as'=>'delete','uses'=>'UserController@getDelete']);
        Route::post('edit/{id}', ['as'=>'update','uses'=>'UserController@update']);

    });
    Route::group(['prefix' => 'category','as'=>'category@'], function () {
        Route::get('/',['as'=>'index','uses'=>'CategoryController@index'] );
        Route::get('add',['as'=>'add','uses'=> 'CategoryController@getAdd']);
        Route::post('store',['as'=>'store','uses'=> 'CategoryController@store'] );
        Route::get('edit/{id}',['as'=>'edit','uses'=>'CategoryController@getEdit'] );
        Route::get('delete/{id}', ['as'=>'delete','uses'=>'CategoryController@getDelete']);
        Route::post('edit/{id}', ['as'=>'update','uses'=>'CategoryController@update']);

    });

    Route::group(['prefix' => 'artist','as'=>'artist@'], function () {
        Route::get('/',['as'=>'index','uses'=>'ArtistController@index'] );
        Route::get('add',['as'=>'add','uses'=> 'ArtistController@getAdd']);
        Route::post('store',['as'=>'store','uses'=> 'ArtistController@store'] );
        Route::get('edit/{id}',['as'=>'edit','uses'=>'ArtistController@getEdit'] );
        Route::get('delete/{id}', ['as'=>'delete','uses'=>'ArtistController@getDelete']);
        Route::post('edit/{id}', ['as'=>'update','uses'=>'ArtistController@update']);

    });

    Route::group(['prefix' => 'product','as'=>'product@'], function () {
        Route::get('/',['as'=>'index','uses'=>'ProductController@index'] );
        Route::get('add',['as'=>'add','uses'=> 'ProductController@getAdd']);
        Route::post('store',['as'=>'store','uses'=> 'ProductController@store'] );
        Route::get('edit/{id}',['as'=>'edit','uses'=>'ProductController@getEdit'] );
        Route::get('delete/{id}', ['as'=>'delete','uses'=>'ProductController@getDelete']);
        Route::post('edit/{id}', ['as'=>'update','uses'=>'ProductController@update']);
    });

    Route::group(['prefix' => 'order','as'=>'order@'], function () {
        Route::get('/',['as'=>'index','uses'=>'OrderController@index'] );
        Route::get('/detail/{id}',['as'=>'detail','uses'=>'OrderController@detail'] );
        Route::get('edit/{id}',['as'=>'edit','uses'=>'OrderController@getEdit'] );
        Route::post('edit/{id}', ['as'=>'update','uses'=>'OrderController@update']);
        Route::post('changeStatus', ['as'=>'changeStatus','uses'=>'OrderController@changeStatus']);
    });

    Route::group(['prefix' => 'statistic','as'=>'statistic@'], function () {
        Route::get('/',['as'=>'index','uses'=>'StatisticController@index'] );
        Route::get('/getStatistic',['as'=>'getStatistic','uses'=>'StatisticController@getStatistic'] );
    });
});
