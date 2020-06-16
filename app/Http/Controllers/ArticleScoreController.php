<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleScore;
use Illuminate\Support\Facades\Auth;

class ArticleScoreController extends Controller
{
    public function vote($id) {
        $score = new ArticleScore();
        $article = Article::find($id);
        $score->vote = request('form-value');
        $score->article_id = $id;
        $score->user_id = Auth::id();
        $score->save();
        return redirect('/articles/'. $article->id);
    }

}
