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
    Route::get('/borrow/booking', "User\Borrow@bookingGetHome")->name('bookingHome');
    Route::post('/borrow/booking/add', "User\Borrow@bookingPostAdd");
    Route::post('/borrow/booking/delete', "User\Borrow@bookingDelete");
    Route::post('/borrow/booking/set-booking-time', "User\Borrow@bookingSetTimeAndSentRequest");

    Route::get('/reimburse', "User\Reimburse@getAll");
    Route::get('/coming', function () {
        return view('user/coming_soon', []);
    });
    Route::group(['middleware' => 'ChechkAdmin'], function() {
        Route::get('/admin', "Admin\Log@getAll");
        Route::get('/admin/account/', "Admin\Account@getAll");
        Route::get('/admin/account/all', "Admin\Account@getAll");
        Route::get('/admin/account/add', "Admin\Account@getAdd");
        Route::post('/admin/account/add', "Admin\Account@postAdd");
        Route::get('/admin/account/delete/{id}', "Admin\Account@delete");
        Route::get('/admin/account/edit/{id}', "Admin\Account@getEdit");
        Route::post('/admin/account/edit/{id}', "Admin\Account@postEdit");
        Route::get('/admin/account/history', "Admin\Account@getHistory");

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
        Route::get('/admin/borrow/booking/verify', "Admin\Borrow@bookingGetVerify")->name('bookingVerifyAdmin');
        Route::post('/borrow/booking/allow', "Admin\Borrow@bookingAllow");
        Route::post('/admin/borrow/booking/deny', "Admin\Borrow@bookingDeny");
        Route::post('/admin/borrow/booking/set-booking-time', "Admin\Borrow@bookingSetTimeAndSentRequest");
        Route::get('/admin/borrow/booking/waiting', "Admin\Borrow@bookingGetWaiting")->name('bookingWaitingAdmin');


        Route::get('/admin/reimburse/', "Admin\Reimburse@getHome");
        Route::post('/admin/reimburse/', "Admin\Reimburse@postHome");
        Route::get('/admin/reimburse/add/{username}', "Admin\Reimburse@getAdd")->name('userProfileReimburse');
        Route::post('/admin/reimburse/add/{username}', "Admin\Reimburse@postAdd");
        Route::get('/admin/reimburse/delete/{id}', "Admin\Reimburse@delete");
        Route::get('/admin/reimburse/all', "Admin\Reimburse@getAll");

        Route::get('/admin/statistics/all', "Admin\Statistics@getAll")->name('adminAllStatistics');
        Route::post('/admin/statistics/refresh', "Admin\Statistics@refresh");

        Route::get('/admin/myaccount', "Admin\MyAccount@get");
        Route::post('/admin/myaccount', "Admin\MyAccount@post");
        Route::post('/admin/myaccount/changepassword', "Admin\MyAccount@changePwd");
        Route::get('/admin/coming', function () {
            return view('admin/coming_soon', []);
        });
    });
});


Route::get('/login', 'Auth\LoginController@getLogin');
Route::post('/login', 'Auth\LoginController@postLogin');
Route::get('/logout', 'Auth\LoginController@getLogout');
