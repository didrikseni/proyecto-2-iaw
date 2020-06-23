<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleFile extends Model
{
    public function article() {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
