<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    protected $guarded = [];

    public function path() {
        return route('articles.show', $this);
    }

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function score() {
        return $this->belongsToMany(ArticleScore::class);
    }

    public function getFile() {
        return $this->hasOne(ArticleFile::class);
    }

    public function hasFile() {
        return ArticleFile::where('article_id', '=', $this->id)->exists();
    }

    public static function getFeaturedArticles() {
        return Article::join('article_scores', 'article_scores.article_id', '=', 'articles.id')
            ->groupBy('articles.id')
            ->orderByRaw('AVG(article_scores.vote) DESC')
            ->select('articles.*')
            ->limit(5)
            ->get();
    }

    public function reports() {
        return $this->hasMany(ArticlesReports::class);
    }

    public function bookmarks() {
        return $this->hasMany(SavedArticle::class);
    }
}
