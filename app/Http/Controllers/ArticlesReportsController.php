<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticlesReports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticlesReportsController extends Controller
{
    public function reports() {
        if (Auth::user()->role == 'admin') {
            $articles = ArticlesReports::getArticlesWithReports();
            return view('articles.reports',['articles' => $articles]);
        } else {
            return redirect('/home');
        }
    }
}
