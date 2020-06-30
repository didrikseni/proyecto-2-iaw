@extends('layouts.app')

@section('content')
    <div id="wrapper">
        <div class="container">
            <div id="card">
                <div id="search_box">
                    <form method="POST" action="/articles/search">
                        @csrf
                        <div class="row pb-4 pt-4 justify-content-end">
                            <div class="col-8">
                                <input class="input-group form-control" type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Buscar un artículo...">
                            </div>
                            <div class="col-auto">
                                <button class="transparent-btn"><i class="fas fa-search fa-lg"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-header">
                    <h3 class="text-center">
                        <a href="/articles" class="custom-text card-link">{{ __('Artículos') }}</a>
                    </h3>
                </div>
                <div class="card-body">
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
                                        <p class="custom-text">
                                            Autor:<a href="/profile/{{ $article->user_id }}">{{ \App\User::find($article->user_id)->name }}</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <hr>
                        @empty
                            No existen artículos para mostrar.
                        @endforelse
                    </ul>
                </div>
                <div class="row">
                    <div class="col-auto ml-auto">
                        <p>{{ $articles->links('layouts/customPaginationView') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
