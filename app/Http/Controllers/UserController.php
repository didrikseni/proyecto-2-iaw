<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        return view('users.profile', [
            'user' => Auth::user(),
            'articles' => (Auth::user()->articles())->orderBy('updated_at', 'desc')->paginate(6),
        ]);
    }

    public function show(User $user){
        return view('users.show', [
            'user' => $user,
            'articles' => ($user->articles())->orderBy('updated_at', 'desc')->paginate(6),
        ]);
    }

    public function store() {
        return view('/users.profile');
    }

    public function changePassword() {
        return view('/users.profile');
    }
}
