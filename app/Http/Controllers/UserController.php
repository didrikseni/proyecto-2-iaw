<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function updatePassword() {
        request()->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => 'required|string|min:8',
            'password_confirmation' => 'same:password'
        ]);

        User::find(Auth::id())->update(['password' => Hash::make(request()->password)]);
        Auth::logout();
        return view('/auth.login');
    }

    public function updateAvatar(User $user) {
        $avatar = request()->avatar;
        $content = $avatar->openFile()->fread($avatar->getSize());
        $user->avatar = $content;
        $user->save();
        redirect('/home');
    }
}
