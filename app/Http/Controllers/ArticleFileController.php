<?php

namespace App\Http\Controllers;

use App\ArticleFile;

class ArticleFileController extends Controller
{
    public function show(ArticleFile $articleFile) {
        $data = base64_decode($articleFile->data);
        header('Content-type: application/pdf');
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
        header("Content-length: ".strlen($data));
        die($data);
    }
}
