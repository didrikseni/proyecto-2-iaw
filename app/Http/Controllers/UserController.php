<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Symfony\Component\Console\Input\Input;
use Illuminate\Http\Request;

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

    public function updateAvatar(Request $request) {
        //$content = request()->avatar->openFile()->fread(request()->avatar->getSize());

        $temp = file_get_contents(request()->file('avatar'));
        $user = auth()->user();
        $user->avatar = base64_encode($temp);
        $user->save();
        return redirect('/home');
    }
}
