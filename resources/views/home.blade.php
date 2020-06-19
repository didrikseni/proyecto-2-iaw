@extends('layouts.app')

@section('content')
    <div class="container page-content">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-sm-5">
                <h2 class="text-justify">Perfil</h2>
                <div class="row">
                    <i class="fas fa-user fa-5x col-2"></i>
                    <p class="text-center col-3 custom-text">{{ $user->name }}</p>
                </div>
                <br>
                <p class="custom-text">{{ $user->email }}</p>
            </div>
            <div class="col-sm-7 text-justify card mb-4">
                <h2>Ultimos posts</h2>
                <hr>
                <ul class="list-unstyled ml-2">
                    @foreach($articles as $article)
                        <li>
                            <div class="row">
                                <div class="col-8">
                                    <a href="/articles/{{ $article->id }}"><h4>{{ $article->title }}</h4></a>
                                </div>
                                <div class="col-3 ml-auto">
                                    <p>Score: {{ (new \App\ArticleScore())->score($article) }}</p>
                                </div>
                            </div>
                            <p>{{ $article->description }}</p>
                        </li>
                        <hr>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
