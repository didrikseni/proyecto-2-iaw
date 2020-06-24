<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleImage;
use Illuminate\Http\Request;

class ArticleImageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function store() {
        $articleImage = ArticleImage::create([
            'image' => request()->all(),
            'article_id' => $article->id
        ]);
        $articleImage->store();
        return $articleImage->id;
    }
}
