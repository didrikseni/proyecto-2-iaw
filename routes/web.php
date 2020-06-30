<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/', 'HomeController@welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::put('/profile/config', 'UserController@updateConfig');
Route::put('/profile/password',  'UserController@updatePassword');
Route::put('/profile/avatar', 'UserController@updateAvatar');
Route::resource('profile', 'UserController');
Route::post('/articles/search', 'ArticlesController@search');
Route::post('/articles/{article}/vote', 'ArticleScoreController@vote');
Route::resource('articles', 'ArticlesController');
Route::get('/tags/{tag}', 'TagController@show');
Route::get('/article/files/{articleFile}', 'ArticleFileController@show');

