@extends('layouts/app')

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
                        @forelse ($articles as $article)
                            <li class="pt-2">
                                <div class="row">
                                    <div class="col-8">
                                        <a href="/articles/{{ $article->id }}" class="custom-text"><h4>{{ $article->title }}</h4></a>
                                    </div>
                                    <div class="col-3 ml-auto">
                                        <p class="custom-text">Score: {{ (new \App\ArticleScore())->score($article) }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <p class="custom-text">{{ $article->description }}</p>
                                    </div>
                                    <div class="col-4 ml-auto">
                                        <p class="custom-text">Autor:  <a href="/profile/{{ $article->user_id }}" class="custom-text">{{ \App\User::find($article->user_id)->name }}</a></p>
                                    </div>
                                </div>
                            </li>
                            <hr>
                        @empty
                            No existen artículos para mostrar.
                        @endforelse
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
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h4 class="custom-text">Usuarios destacados</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Content -->
@endsection
