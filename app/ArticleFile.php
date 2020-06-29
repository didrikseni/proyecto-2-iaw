<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleFile extends Model
{
    public static function storeFiles(array $files, Int $article_id) {
        foreach ($files as $file) {
            $articleFile = ArticleFile::create([
                'article_id' => $article_id,
                'content' => file_get_contents($file)
            ]);
            $articleFile->save();
        }
    }

    public function article() {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
