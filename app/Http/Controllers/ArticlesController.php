<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleFile;
use App\Tag;
use DOMDocument;
use Illuminate\Support\Facades\Auth;


class ArticlesController extends Controller {

    public function __construct() {
        $this->middleware('auth')->except('index' , 'show');
    }

    public function index() {
        $articles = Article::latest()->paginate(12);
        return view('articles.index', ['articles' => $articles]);
    }

    public function show(Article $article) {
        return view('articles.show', ['article' => $article]);
    }

    public function create() {
        return view('articles.create', ['tags' => Tag::all()]);
    }

    public function store() {
        $this->validateArticle();
        $article = new Article([
            'title' => request()->get('title'),
            'description' => request()->get('description'),
            'content' => request()->get('content'),
            'user_id' => Auth::id()
        ]);
        $article->save();
        $this->saveFiles($article);
        $article->update(['content' => $this->processImages($article->id)]);
        $article->tags()->attach(request('tags'));
        return redirect('/home');
    }

    public function edit(Article $article) {
        return view('articles.edit', compact('article'));
    }

    public function update(Article $article) {
        if ($article->user_id == Auth::id())
            $article->update(array_merge($this->validateArticle(), ["user_id" => Auth::id()]));
        return redirect('/articles/' . $article->id);
    }

    public function destroy(Article $article) {
        if (auth()->id() == $article->user_id or auth()->user()->role == 'admin') {
            $article->delete();
            return redirect('/home');
        } else {
            return redirect('/articles/'. $article->id);
        }
    }

    public function validateArticle(): array {
        return request()->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:500',
            'content' => 'required',
            'tags' => 'exists:tags,id'
        ]);
    }

    public function search() {
        $articles = Article::where('title', 'like', '%'. request()->get('title') .'%')->latest()->paginate(15);
        return view('articles.index', ['articles' => $articles]);
    }

    private function processImages(Int $id) {
        $dom = new DOMDocument();
        $dom->loadHTML(request()->get('content'));
        $images = $dom->getElementsByTagName('img');
        if (count($images) == 0)  return request()->get('content');
        for ($i = 0; $i < count($images); $i++) {
            $imageID = ArticleImageController::storeInDatabase($images[$i]->getAttribute('src'), $images[$i]->getAttribute('alt'), $id);
            $images[$i]->setAttribute('src', 'image/' . $imageID);
            $images[$i]->setAttribute('data-mce-src', 'image/' . $imageID);
        }
        return $dom->saveHTML();
    }

    private function saveFiles(Article $article) {
       //ArticleFile::storeFiles(request()->all()['files'], $article->id);
    }
}
