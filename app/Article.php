<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model {

    protected $guarded = [];

    public function path() {
        return route('articles.show', $this);
    }

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags(){
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
        /*
         return Article::select('users.name')
        ->addSelect(Article::where('user.id', 'articles.user_id')->count())
        ->orderBy('cant', 'desc')->take(10);
        return Article::withCount(['score as avg_score' => function($query) {
            $query->select(DB::raw('coalesce(avg(vote),0)'));
        }])->orderByDesc('avg_score')->get();*/

        return Article::orderBy('id', 'desc')->take(10)->get();

        //return Article::withCount('score')->orderBy('score_count', 'desc')->take(10)->get();

    }
}
