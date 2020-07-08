<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleScore;
use Illuminate\Support\Facades\Auth;

class ArticleScoreController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function vote(Article $article) {
        $score = new ArticleScore();
        $score->vote = request('form-value');
        $score->article_id = $article->id;
        $score->user_id = Auth::id();
        $score->save();
        return redirect('/articles/'. $article->id);
    }

}
