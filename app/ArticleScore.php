<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleScore extends Model
{
    public function articles() {
        $this->belongsToMany(Article::class);
    }

    public function users() {
        $this->belongsToMany(User::class);
    }
}
