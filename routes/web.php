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
Route::get('/articles', 'ArticlesController@index');
Route::post('/articles', 'ArticlesController@store');
Route::get('/articles/create', 'ArticlesController@create');
Route::get('/articles/{article}', 'ArticlesController@show');
Route::get('/articles/{article}/edit', 'ArticlesController@edit');
Route::put('/articles/{article}', 'ArticlesController@update');
Route::post('/articles/{article}/vote', 'ArticleScoreController@vote');
Route::post('/articles/image/upload', 'ArticleImageController@store');
Route::get('/articles/image/{articleImage}', 'ArticleImageController@show');
Route::get('/profile/{user}', 'UserController@show');
Route::get('/profile', 'UserController@index');
Route::put('/profile', 'Usercontroller@store');
Route::put('/profile/password',  'UserController@updatePassword');
Route::put('/profile/avatar', 'UserController@updateAvatar');
Route::get('/tags/{tag}', 'TagController@show');
