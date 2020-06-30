<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleFile extends Model {
    protected $fillable = ['article_id', 'content'];

    public function storeFiles(UploadedFile $file, $id) {
        $articleFile = ArticleFile::create([
            'article_id' => $id,
            'content' => base64_encode($file->get())
        ]);
        //base64_encode($file->get());
        //file_get_contents($file)
        $articleFile->save();
    }

    public function article() {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
