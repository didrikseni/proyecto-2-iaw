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
        $this->middleware('auth')->except('show');
    }

    public function index() {
        return view('users.profile', [
            'user' => Auth::user(),
            'articles' => (Auth::user()->articles())->orderBy('updated_at', 'desc')->paginate(6),
        ]);
    }

    public function show($id) {
        if (User::where('id', $id)->exists()) {
            $user = User::where('id', $id)->first();
            return view('users.show', [
                'user' => $user,
                'articles' => ($user->articles())->orderBy('updated_at', 'desc')->paginate(6),
            ]);
        } else {
            return abort(404);
        }
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

    public function updateAvatar() {
        request()->validate(['avatar' => 'required']);
        $temp = file_get_contents(request()->file('avatar'));
        $user = auth()->user();
        $user->avatar = base64_encode($temp);
        $user->save();
        return redirect('/home');
    }

    public function updateConfig() {
        $user = auth()->user();
        if (request()->get('name') != "") {
            $user->name = request()->get('name');
        }
        if (request()->get('email') != "") {
            $user->email = request()->get('email');
        }
        $user->save();
        return redirect('/home');
    }
}
