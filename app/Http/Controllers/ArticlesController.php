<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Support\Facades\Auth;


class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articles = Article::latest()->get();
        return view('articles.index', ['articles' => $articles]);
    }

    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store()
    {
        $article = array_merge($this->validateArticle(), ["user_id" => Auth::id()]);
        $article = $this->processImages($article);
        Article::create($article);
        return redirect('/home');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Article $article)
    {
        if ($article->user_id == Auth::id())
            $article->update(array_merge($this->validateArticle(), ["user_id" => Auth::id()]));
        return redirect('/articles/' . $article->id);
    }

    public function destroy()
    {

    }

    /**
     * @return array
     */
    public function validateArticle(): array
    {
        return request()->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:500',
            'content' => 'required',
        ]);
    }

    private function processImages(array $article)
    {
        $strips = $this->getImageTags($article['content']);
        if ($strips == []) dd('LPM NO ENCONTRO');
        else dd($strips);
    }


    private function getImageTags($string, $result = 'string')
    {
        //if (preg_match_all('/<img([\w\W]+?)\/>/', $string, $matches, PREG_SET_ORDER)) {
        if (preg_match_all('/;base64([\w\W]+?)\" alt="/', $string, $matches, PREG_SET_ORDER)) {
            $string = [];
            foreach ($matches as $match) {
                $string[] = $match[1];
            }
            dd($string);
            return $string;
        } else {
            return [];
        }
    }
}
