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
use App\Jobs\EmailQueue;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/queue', array('as' => 'queue', 'uses' => 'LoginController@queue'));

Route::get('/setfoo', array('as' => 'setfoo', 'uses' => 'LoginController@setfoo'));
Route::post('/postlogin', array('as' => 'postlogin', 'uses' => 'LoginController@postlogin'));
Route::get('/error', array('as' => 'error', 'uses' => 'LoginController@error'));

Route::get('/dashboard', array('as' => 'dashboard', 'uses' => 'LoginController@dashboard'))->middleware('checklogin');


Route::get('/emailsend', array('as' => 'emailsend', 'uses' => 'LoginController@emailsend'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'LoginController@logout'));


Route::post('/chunkemail', array('as' => 'chunkemail', 'uses' => 'LoginController@chunkemail'));