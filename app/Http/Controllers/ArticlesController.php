<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use DOMDocument;
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
        return view('articles.create', ['tags' => Tag::all()]);
    }

    public function store()
    {
        $this->validateArticle();

        $article = new Article([
            'title' => request()->get('title'),
            'description' => request()->get('description'),
            'content' => '',
            'user_id' => Auth::id()
        ]);
        $article->save();
        $imageSources = $this->processImages($article);
        $article->update(['content' => $this->changeImageSources($imageSources)]);
        $article->tags()->attach(request('tags'));
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
            'tags' => 'exists:tags,id'
        ]);
    }

    private function processImages(Article $article)
    {
        $strips = $this->getImageTags(request()->get('content'));
        if ($strips != []) {
            return ArticleImageController::storeInDatabase($strips, $article);
        } else {
            return [];
        }
    }


    private function getImageTags($string, $result = 'string')
    {
        if (preg_match_all('/;base64,([\w\W]+?)\" alt="/', $string, $matches, PREG_SET_ORDER)) {
            $string = [];
            foreach ($matches as $match) {
                $string[] = $match[1];
            }
            return $string;
        } else {
            return [];
        }
    }

    private function changeImageSources(array $imageSources)
    {
        if ($imageSources != []) {
            $dom = new DOMDocument();
            $dom->loadHTML(request()->get('content'));
            $images = $dom->getElementsByTagName('img');

            for ($i = 0; $i < count($images); $i++) {
                if (strpos($images[$i]->getAttribute('src'), 'portal-uns.herokuapp.com') or
                    strpos($images[$i]->getAttribute('src'), '127.0.0.1:8000')) {
                    $images[$i]->setAttribute('src', 'http://127.0.0.1:8000/articles/image/' . $imageSources[$i]);
                    $images[$i]->removeAttribute('data-mce-src');
                }
            }
            return $dom->saveHTML();
        } else {
            return request()->get('content');
        }

    }
}
