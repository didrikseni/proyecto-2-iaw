<?php

namespace App\Http\Controllers;

use App\ArticleImage;


class ArticleImageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function show(ArticleImage $articleImage) {
        return $articleImage->image;
    }

    public function store() {






        /*
        $accepted_origins = array("http://localhost", "http://192.168.1.1");
        reset ($_FILES);
        $temp = current($_FILES);
        if (is_uploaded_file($temp['tmp_name'])){
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                // same-origin requests won't set an origin. If the origin is set, it must be valid.
                if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
                } else {
                    header("HTTP/1.1 403 Origin Denied");
                    return;
                }
            }

            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }

            // Verify extension
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }

            $imageContent = file_get_contents(pathinfo($temp['name']));
            $articleImage = ArticleImage::create([
                'image' => base64_encode($imageContent),
                'name' => 'somename'
            ]);
            $articleImage->store();

            // Respond to the successful upload with JSON.
            // Use a location key to specify the path to the saved image resource.
            // { location : '/your/uploaded/image/file'}
            echo json_encode(['location' => '/articles/image/' . $articleImage->id]);
        } else {
            // Notify editor that the upload failed
            header("HTTP/1.1 500 Server Error");
        }
        // -------------------------------------------------------------------------------
        $temp = file_get_contents(request()->file('file'));
        $articleImage = ArticleImage::create([
            'image' => base64_encode($temp),
            'name' => 'somename'
        ]);
        $articleImage->store();
        return json_encode(['location' => '/articles/image/' . $articleImage->id]);*/
    }
}
