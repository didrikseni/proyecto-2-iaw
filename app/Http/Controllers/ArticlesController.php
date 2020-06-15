<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $articles = Article::latest()->get();
        return view('articles.index', ['articles' => $articles]);
    }

    public function show(Article $article){
        return view('articles.show', ['article' => $article]);
    }

    public function create(){
        return view('articles.create');
    }

    public function store() {
        Article::create($this->validateArticle());
        return redirect(route('articles.index'));
    }

    public function edit(Article $article) {
        return view('articles.edit', compact('article'));
    }

    public function update(Article $article) {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
        ]);

        $article->title = request('title');
        $article->content = request('content');
        $article->description = request('description');
        $article->save();
        return redirect('/articles' . $article->id);
    }

    public function destroy() {

    }
}
