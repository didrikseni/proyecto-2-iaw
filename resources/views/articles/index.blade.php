@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="container page-content child">
        <div id="search_box">
            <form method="POST" action="/search">
                @csrf
                <div class="row mb-5 mt-5 justify-content-center">
                    <div class="col-8">
                        <input class="input-group form-control" type="text" name="search" id="search" value="{{ old('search') }}" placeholder="Buscar artículo por palabra clave...">
                    </div>
                    <div class="col-auto">
                        <button class="transparent-btn"><i class="fas fa-search fa-lg"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Artículos') }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled ml-2">
                            @include('articles.articleList')
                            <div class="row">
                                <div class="ml-auto">
                                    <p>{{ $articles->links('layouts/customPaginationView') }}</p>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card mb-5">
                    <div class="card-header">
                        <h4 class="custom-text">Artículos destacados</h4>
                    </div>
                    <div class="card-body mx-3">
                        @foreach(\App\Article::getFeaturedArticles() as $article)
                            <div class="row">
                                <a href="/articles/{{ $article->id }}" class="custom-text">{{ $article->title }}</a>
                                <p class="ml-auto">Score: {{ (new \App\ArticleScore())->score($article) }}</p>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h4 class="custom-text">Usuarios destacados</h4>
                    </div>
                    <div class="card-body mx-3">
                        @foreach(\App\User::getFeaturedUsers() as $user)
                            <div class="row">
                                <a href="/profile/{{ $user->id }}" class="custom-text">{{ $user->name }}</a>
                                <p class="ml-auto">{{ $user->articles_count }} Artículos</p>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Content -->
@endsection
