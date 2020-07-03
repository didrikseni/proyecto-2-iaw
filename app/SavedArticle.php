<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SavedArticle extends Model
{

    protected $fillable = ['article_id', 'user_id'];

    public function article() {
        return $this->belongsTo(Article::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function alreadySaved(Article $article) {
        return SavedArticle::where('article_id', $article->id)->where('user_id', Auth::id())->exists();
    }
}
