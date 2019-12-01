<?php

/**
 * Laravel IP Checker
 *
 * @author    Hayri Can BARÇIN <hayricanbarcin (#) gmail (.) com>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/HayriCan/laravel-ip-checker
 */

Route::group(['prefix'=>config('ipchecker.settings.route_prefix')], function () {
    Route::get('/iplists', 'HayriCan\IpChecker\Http\Controllers\IpCheckerController@index')->name('iplist.index');
    Route::post('/ip-add', 'HayriCan\IpChecker\Http\Controllers\IpCheckerController@add')->name('iplist.add');
    Route::delete('/ip-delete', 'HayriCan\IpChecker\Http\Controllers\IpCheckerController@delete')->name('iplist.delete');
});
