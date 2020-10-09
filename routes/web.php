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

// AUTH 

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('login', 'Auth\LoginController@login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/export-winner', 'HomeController@exportExcel')->name('home.export');

Route::group(['prefix' => 'contents', 'as' => 'random.'], function() {
    Route::get('/name', 'RandomNameController@index')->name('name');
    Route::get('/name-roulette', 'RandomNameController@roulette')->name('name-roulette');
    Route::post('/name/{id}', 'RandomNameController@onDecision')->name('name.choose');
    Route::get('/lottery-table', 'RandomLotteryController@index')->name('lottery-table');
    Route::post('/lottery-table/{id}', 'RandomLotteryController@onDecisionPrize')->name('lottery-table.choose');
    Route::get('/lottery-pizza', 'RandomLotteryPizzaController@index')->name('lottery-pizza');
    Route::post('/lottery-pizza/{id}', 'RandomLotteryPizzaController@onDecisionPrize')->name('lottery-pizza.choose');
});

Route::group(['prefix' => 'lists', 'as' => 'lists.'], function() {
    Route::get('/participants', 'ParticipantsController@index')->name('participants');
    Route::post('/participants', 'ParticipantsController@store')->name('participants.post');
    Route::post('/participants/import-excel', 'ParticipantsController@importExcel')->name('participants.import-excel');
    Route::get('/prizes', 'PrizesController@index')->name('prizes');
    Route::post('/prizes', 'PrizesController@store')->name('prizes.post');
    Route::post('/prizes/import-excel', 'PrizesController@importExcel')->name('prizes.import-excel');
});

Route::get('/settings/user', 'UserSettingController@index')->name('settings.user');
Route::post('/settings/user', 'UserSettingController@store')->name('settings.user.store');
Route::post('/settings/user/{id}', 'UserSettingController@update')->name('settings.user.update');
Route::delete('/settings/user/{id}/delete', 'UserSettingController@destroy')->name('settings.user.delete');
