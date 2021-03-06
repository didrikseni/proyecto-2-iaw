<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ArticleScore extends Model
{
    public function articles() {
        $this->belongsToMany(Article::class);
    }

    public function users() {
        $this->belongsToMany(User::class);
    }

    public function score(Article $article) {
        $averageScore = ArticleScore::where('article_id', '=', $article->id)->avg('vote');
        return round($averageScore, 2);
    }

    public function getvote(Article $article) {
        return auth()->user()->votes->where('article_id', '=', $article->id)->first()->vote;
    }

    public static function hasVoted(Article $article) {
        return ArticleScore::where('article_id', '=', $article->id)->where('user_id', '=', Auth::id())->exists();
    }
}
