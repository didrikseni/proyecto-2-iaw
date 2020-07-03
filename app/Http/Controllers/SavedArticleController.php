<?php

namespace App\Http\Controllers;

use App\Article;
use App\SavedArticle;
use Illuminate\Support\Facades\Auth;

class SavedArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        return view('articles.bookmark', [
            'user' => $user,
            'articles' => SavedArticle::getBookmarkedArticles(),
        ]);
    }

    public function store(Article $article) {
        if (SavedArticle::alreadySaved($article)) {
            return redirect()->back()->withError(['msg', 'Fail at added bookmark.']);
        } else {
            $savedArticle = SavedArticle::create([
                'user_id' => Auth::id(),
                'article_id' => $article->id,
            ]);
            $savedArticle->save();
            return redirect()->back();
        }
    }

    public function destroy(Article $article) {
        if (SavedArticle::alreadySaved($article)) {
            $savedArticle = SavedArticle::where('user_id', Auth::id())->where('article_id', $article->id)->first();
            $savedArticle->delete();
            return redirect()->back();
        } else {
            return redirect()->back()->withError(['msg', 'Fail at removing bookmark.']);
        }
    }
}
