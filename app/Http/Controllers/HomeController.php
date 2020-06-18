<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('home', [
            'user' => Auth::user(),
            'articles' => Article::orderBy('updated_at', 'desc')->paginate(6)
        ]);
    }

    public function welcome() {
        return view('welcome');
    }
}