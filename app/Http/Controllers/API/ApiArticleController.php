<?php

namespace App\Http\Controllers\API;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //take(5)
        $articles = Article::orderBy('updated_at', 'desc')->take(15)->get();
        $response = array();
        foreach ($articles as $article) {
            $response[] = [
                'title' => $article->title,
                'description' => $article->description,
                'content' => $article->content,
                'tags' => $article->tags->pluck('name'),
                'file' => $article->hasFile() ? $article->getFile->id : '',
                'author' => $article->author->name,
                'score' => (new \App\ArticleScore())->score($article)
            ];
        }
        return response(json_encode($response), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(json_encode([
            'title' => 'some title here, maximum 255 chars',
            'description' => 'description of the article, maximum 500 chars',
            'content' => 'some content to display, images must be encoded en base64',
            'tags' => 'optional, must be some valid tag in /api/tags',
            'file' => 'optional, must be pdf'
        ]), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $article = Article::where('id', $id)->first();
        return response(json_encode([
            'title' => $article->title,
            'description' => $article->description,
            'content' => $article->content,
            'tags' => $article->tags->pluck('name'),
            'file' => $article->hasFile() ? $article->getFile->id : '',
            'author' => $article->author->name,
            'score' => (new \App\ArticleScore())->score($article)
        ]), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
