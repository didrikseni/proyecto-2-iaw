<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except('show');
    }

    public function show(Tag $tag) {
        $articles = $tag->articles()->orderBy('updated_at', 'desc')->paginate(12);
        return view('articles.index', ['articles' => $articles]);
    }
}
