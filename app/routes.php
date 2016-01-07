<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::pattern('id', '[0-9]+');
Route::pattern('date', '[0-9]+');
Route::pattern('month', '[0-9]+');
Route::pattern('year', '[0-9]+');

/* App::missing(function($exception) 
{
    return Redirect::to('error');
});
 */
Route::get('/', array('as' => 'backend_home', 'uses' => 'LandingController@index'));
Route::get('/error', array('as' => 'backend_error', 'uses' => 'LandingController@error'));

Route::resource('user', 'UserController');
Route::resource('balance', 'BalanceController');
Route::resource('transfer', 'TransferController');
Route::resource('login', 'SessionController');
Route::get('logout', array('as' => 'logout', 'uses' => 'SessionController@logout'));