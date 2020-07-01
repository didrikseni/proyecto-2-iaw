<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APIHelperController extends Controller
{
    public function show() {
        return request()->user();
    }

    public function getRoutes() {
        Route::post('login', 'API\AuthController@login')->name('login');
        Route::post('register', 'API\AuthController@register');
        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('logout', 'API\AuthController@logout');
            Route::get('user', 'API\AuthController@user');
        });
    }
}
