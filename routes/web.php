<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/',function ()
{
   return redirect(\route('post.index'));
});
Route::resource('post','PostController');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
