@extends('layouts.app')

@section('content')
    <div class="container page-content">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">{{ __('Perfil') }}</div>
                    <div class="row justify-content-center">
                        @if ($user->avatar == null)
                            <i class="fas fa-user fa-5x col-2 m-5"></i>
                        @else
                            <h1>ACA VA LA IMAGEEEN</h1>
                        @endif
                        <p class="text-center col-3 custom-text m-5">{{ $user->name }}</p>
                    </div>
                    <br>
                    <p class="custom-text text-center">{{ $user->email }}</p>
                    <div class="text-center p-5">
                        <button class="btn btn-primary"> <a href="/profile" class="custom-text">Modificar perfil</a></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 text-justify mb-4">
                <div class="card">
                    <div class="card-header">{{ __('Ultimos artículos') }}</div>
                    <ul class="list-unstyled ml-2">
                        @foreach($articles as $article)
                            <li class="pt-2">
                                <div class="row">
                                    <div class="col-8">
                                        <a href="/articles/{{ $article->id }}" class="custom-text"><h4>{{ $article->title }}</h4></a>
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
                                        <p>
                                            Autor:<a href="/profile/{{ $article->user_id }}">{{ \App\User::find($article->user_id)->name }}</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <hr>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
