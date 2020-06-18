<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Support\Facades\Auth;

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
        $article = array_merge($this->validateArticle(), ["user_id" => Auth::id()]);
        Article::create($article);
        return redirect('/home');
    }

    public function edit(Article $article) {
        return view('articles.edit', compact('article'));
    }

    public function update(Article $article) {
        if ($article->id == Auth::id())
            $article->update(array_merge($this->validateArticle(), ["user_id" => Auth::id()]));
        return redirect('/articles/' . $article->id);
    }

    public function destroy() {

    }

    /**
     * @return array
     */
    public function validateArticle(): array {
         return request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:10', 'max:500'],
            'content' => 'required',
        ]);
    }
}
