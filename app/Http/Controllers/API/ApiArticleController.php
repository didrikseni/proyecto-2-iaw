<?php

namespace App\Http\Controllers\API;

use App\Article;
use App\ArticleFile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ApiArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try {
            $articles = Article::orderBy('updated_at', 'desc')->take(50)->get();
            $response = array();
            foreach ($articles as $article) {
                $response[] = [
                    'title' => $article->title,
                    'description' => $article->description,
                    'content' => $article->content,
                    'tags' => $article->tags->pluck('name'),
                    'file' => $article->hasFile() ? $article->getFile->id : '',
                    'author' => $article->author->name,
                ];
            }
            return response(json_encode($response), 200);
        } catch (\Exception $exception) {
            return response("Server error", 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(json_encode([
            'title' => 'some title here, max 255 char',
            'description' => 'description of the article, max 500 char',
            'content' => 'some content to display in html format, images must be encoded en base64',
            'tags' => 'optional, must be some valid tag in /api/api_tags',
            'file' => 'optional, must be pdf',
            'max_post_size' => '6MB per article'
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
        try {
            $article = Article::create(array_merge($this->validateArticle(), ['user_id' => Auth::id()]));
            $article->save();
            $this->saveFiles($article->id);
            $article->tags()->attach(request('tags'));
            return response("Article created correctly", 200);
        } catch (ValidationException $exception) {
            return response('Error when validating, check parameters (/api/api_articles/create) and send it again', 406 );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            $article = Article::where('id', $id)->first();
            return response(json_encode([
                'title' => $article->title,
                'description' => $article->description,
                'content' => $article->content,
                'tags' => $article->tags->pluck('name'),
                'file' => $article->hasFile() ? $article->getFile->id : '',
                'author' => $article->author->name,
            ]), 200);
        } catch (\Exception $exception) {
            return response("Server error", 500);
        }

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
        $article = Article::where('id', $id)->first();
        if ($article->user_id == Auth::id()){
            try {
                $article->update(array_merge($this->validateArticle(), ["user_id" => Auth::id()]));
                return response("Article updated correctly", 200);
            } catch (ValidationException $ex) {
                return response('Error when validating, check parameters (/api/api_articles/create) and send it again', 406 );
            }
        } else {
            return response("You're trying to edit an article that's not yours.",401 );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::where('id', $id)->first();
        if (Auth::id() == $article->user_id or Auth::user()->role == 'admin') {
            $article->delete();
            return response("Article deleted correctly.",200 );

        } else {
            return response("You're trying to delete an article that's not yours.",401 );
        }
    }

    private function validateArticle(): array {
        return request()->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:500',
            'content' => 'required',
            'tags' => 'exists:tags,id'
        ]);
    }

    private function saveFiles($id) {
        if (request()->has('file')) {
            $articleFiles = new ArticleFile();
            $articleFiles->storeFiles(request()->file('file'), $id);
        }
    }
}
