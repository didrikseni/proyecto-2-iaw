<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', 'API\APIHelperController@show');

Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');
Route::post('/logout', 'API\AuthController@logout')->middleware('auth:api');
Route::get('/isLoggedIn', 'API\AuthController@isLoggedIn');

Route::resource('/api_articles', 'API\ApiArticleController');
Route::resource('/api_users', 'API\ApiUserController')->middleware('auth:api');
Route::resource('/api_tags', 'API\ApiTagController')->middleware('auth:api');
Route::resource('/api_files', 'API\ApiFileController')->middleware('auth:api');
