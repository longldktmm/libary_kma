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
Route::group(['middleware' => 'auth'], function() {
    Route::get('', "User\SuggestDocument@getAll");
    Route::get('home', "User\SuggestDocument@getAll");
    Route::get('/myaccount', "User\MyAccount@get");
    Route::post('/myaccount', "User\MyAccount@post");
    Route::post('/myaccount/changepassword', "User\MyAccount@changePwd");

    Route::get('/borrow', "User\Borrow@getAll");
    Route::get('/reimburse', "User\Reimburse@getAll");

    Route::group(['middleware' => 'ChechkAdmin'], function() {
        Route::get('/admin', "Admin\Log@getAll");
        Route::get('/admin/account/', "Admin\Account@getAll");
        Route::get('/admin/account/all', "Admin\Account@getAll");
        Route::get('/admin/account/add', "Admin\Account@getAdd");
        Route::post('/admin/account/add', "Admin\Account@postAdd");
        Route::get('/admin/account/delete/{id}', "Admin\Account@delete");
        Route::get('/admin/account/edit/{id}', "Admin\Account@getEdit");
        Route::post('/admin/account/edit/{id}', "Admin\Account@postEdit");

        Route::get('/admin/document/', "Admin\Document@getAll");
        Route::get('/admin/document/all', "Admin\Document@getAll");
        Route::get('/admin/document/add', "Admin\Document@getAdd");
        Route::post('/admin/document/add', "Admin\Document@postAdd");
        Route::get('/admin/document/delete/{id}', "Admin\Document@delete");
        Route::get('/admin/document/edit/{id}', "Admin\Document@getEdit");
        Route::post('/admin/document/edit/{id}', "Admin\Document@postEdit");

        Route::get('/admin/borrow/', "Admin\Borrow@getHome");
        Route::post('/admin/borrow/', "Admin\Borrow@postHome");
        Route::get('/admin/borrow/add/{username}', "Admin\Borrow@getAdd")->name('userProfile');
        Route::post('/admin/borrow/add/{username}', "Admin\Borrow@postAdd");
        Route::get('/admin/borrow/delete/{id}', "Admin\Borrow@delete");
        Route::get('/admin/borrow/all', "Admin\Borrow@getAll");

        Route::get('/admin/reimburse/', "Admin\Reimburse@getHome");
        Route::post('/admin/reimburse/', "Admin\Reimburse@postHome");
        Route::get('/admin/reimburse/add/{username}', "Admin\Reimburse@getAdd")->name('userProfileReimburse');
        Route::post('/admin/reimburse/add/{username}', "Admin\Reimburse@postAdd");
        Route::get('/admin/reimburse/delete/{id}', "Admin\Reimburse@delete");
        Route::get('/admin/reimburse/all', "Admin\Reimburse@getAll");

        Route::get('/admin/account/myaccount', "Admin\MyAccount@get");
        Route::post('/admin/account/myaccount', "Admin\MyAccount@post");
        Route::post('/admin/account/myaccount/changepassword', "Admin\MyAccount@changePwd");
    });
});


Route::get('/login', 'Auth\LoginController@getLogin');
Route::post('/login', 'Auth\LoginController@postLogin');
Route::get('/logout', 'Auth\LoginController@getLogout');
