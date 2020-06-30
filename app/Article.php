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

    public function tags(){
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function score() {
        return $this->belongsToMany(ArticleScore::class);
    }

    public function getFile() {
        return $this->hasOne(ArticleFile::class);
    }

    public function hasFiles() {
        return ArticleFile::where('article_id', '=', $this->id)->exists();
    }
}
