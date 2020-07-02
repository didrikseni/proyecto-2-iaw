@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="container page-content child">
        <div id="search_box">
            <form method="POST" action="/articles/search">
                @csrf
                <div class="row mb-5 mt-5 justify-content-center">
                    <div class="col-8">
                        <input class="input-group form-control" type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Buscar un artículo...">
                    </div>
                    <div class="col-auto">
                        <button class="transparent-btn"><i class="fas fa-search fa-lg"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row child justify-content-center">
            <div class="card">
                <div class="card-body mb-5 mt-5 col-auto">
                    <ul class="list-unstyled ml-2">
                        @include('articles.articleList', ['articles' => $articles])
                        <div class="row">
                            <div class="col-auto ml-auto">
                                <p>{{ $articles->links('layouts/customPaginationView') }}</p>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="col-auto">
                <div class="card mb-5">
                    <div class="card-header">
                        <h4 class="custom-text">Artículos destacados</h4>
                        <div class="card-body">
                            @foreach(\App\Article::getFeaturedArticles() as $article)
                                <div class="row">
                                    <a href="/articles/{{ $article->id }}">{{ $article->title }}</a>
                                    <p>Con {{ $article->score_count }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h4 class="custom-text">Usuarios destacados</h4>
                        <div class="card-body">
                            @foreach(\App\User::getFeaturedUsers() as $user)
                                <div class="row">
                                    <a href="/profile/{{ $user->id }}">{{ $user->name }}</a>
                                    <p>Con {{ $user->articles_count }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Content -->
@endsection
