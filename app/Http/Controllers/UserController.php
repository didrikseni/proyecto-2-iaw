<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(User $user) {
        return view('users.profile', ['user' => Auth::user()]);
    }

    public function show(User $user){
        return view('users.show', [
            'user' => $user,
            'articles' => ($user->articles())->orderBy('updated_at', 'desc')->paginate(6),
        ]);
    }
}
