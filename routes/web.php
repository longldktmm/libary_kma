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
Route::get('test', function () {
    echo 'err';
    return view('MyFirstView');
});
//

Route::get('controller', 'MyFirstController@getController');

Route::get('view', 'MyFirstController@getView');
Route::post('addMaths', 'MyFirstController@postAddQuestion');
Route::get('addMaths', 'MyFirstController@getAddQuestion');


Route::get('/sayhello', function() {
    echo 'Hello Laravel! I am a new chicken';
});


Route::get('product', function() {
    echo 'Sản phẩm';
});
Route::group(['prefix' => 'product'], function() {
    Route::get('add', function() {
        echo 'Thêm nội dung';
    });
    Route::get('edit', function() {
        echo 'Sửa nội dung';
    });
    Route::get('del', function() {
        echo 'Xóa nội dung';
    });
});
