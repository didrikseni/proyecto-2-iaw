<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleFile extends Model
{
    protected $fillable = ['article_id', 'data', 'name', 'mime'];

    public function storeFiles(UploadedFile $file, $id)
    {
        $articleFile = ArticleFile::create([
            'name' => $file->getClientOriginalName(),
            'mime' => $file->getClientMimeType(),
            'data' => base64_encode($file->get()),
            'article_id' => $id
        ]);
        $articleFile->save();
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
