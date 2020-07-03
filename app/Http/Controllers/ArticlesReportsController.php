<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticlesReports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticlesReportsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function reports() {
        if (Auth::user()->role == 'admin') {
            $articles = ArticlesReports::getArticlesWithReports();
            return view('reports.reports',['articles' => $articles]);
        } else {
            return redirect('/home');
        }
    }

    public function getReportForm(Article $article) {
        return view('reports.reason', ['article' => $article]);
    }

    public function reportArticle(Article $article) {
        $articleReport = ArticlesReports::create([
            'reason' => ArticlesReports::getReasonID(request()->get('reason')),
            'user_id' => Auth::id(),
            'article_id' => $article->id
        ]);
        $articleReport->save();
        return redirect('/home');
    }


}
