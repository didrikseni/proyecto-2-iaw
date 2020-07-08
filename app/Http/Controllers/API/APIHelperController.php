<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APIHelperController extends Controller
{
    public function show() {
        return request()->user();
    }
}
