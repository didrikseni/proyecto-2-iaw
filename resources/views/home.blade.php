@extends('layouts.profilelayout')

@section('all_articles')
    <div class="card row">
        <div>
            <a href="/articles" class="card-link custom-button text-uppercase">Todos los artículos</a>
        </div>
    </div>
@endsection

@section('articles_show')
    <div class="card-header"><h4>{{ __('Ultimos artículos') }}</h4></div>
    <ul class="list-unstyled ml-2">
        @forelse ($articles as $article)
            <li class="pt-2">
                <div class="row">
                    <div class="col-8">
                        <a href="/articles/{{ $article->id }}" class="card-link custom-text">
                            <h5>{{ $article->title }}</h5></a>
                    </div>
                    <div class="col-3 ml-auto">
                        <p>Score: {{ (new \App\ArticleScore())->score($article) }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-7">
                        <p>{{ $article->description }}</p>
                    </div>
                    <div class="col-4 ml-auto">
                        <p>Autor: <a href="/profile/{{ $article->user_id }}" class="custom-text">{{ \App\User::find($article->user_id)->name }}</a></p>
                    </div>
                </div>
            </li>
            <hr>
        @empty
            <p>Todavía no existen artículos para mostrar.</p>
        @endforelse
    </ul>
@endsection
