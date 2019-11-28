<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/


Route::group(['prefix'=>config('ipchecker.settings.route_prefix')], function () {
    Route::get('/iplists', 'HayriCan\IpChecker\Http\Controllers\IpCheckerController@index')->name('iplist.index');
    Route::post('/ip-add', 'HayriCan\IpChecker\Http\Controllers\IpCheckerController@add')->name('iplist.add');
    Route::delete('/ip-delete', 'HayriCan\IpChecker\Http\Controllers\IpCheckerController@delete')->name('iplist.delete');
});
