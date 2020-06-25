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
                    <div class="card-header"><a href="/articles" class="card-link custom-text mr-0"><h4>Todos los artículos</h4></a></div>
                </div>
                <br> <br>
                <div class="card">
                    <div class="card-header"><h4>{{ __('Perfil') }}</h4></div>
                    <div class="row justify-content-center">
                        @if ($user->avatar == null)
                            <i class="fas fa-user fa-5x col-2 m-5"></i>
                        @else
                            <img src="data:image/jpg;base64, {{ stream_get_contents($user->avatar) }}" style="border-radius:50%" class="centered-and-cropped" width="200" height="200">
                        @endif
                        <p class="text-center col-3 custom-text m-5">{{ $user->name }}</p>
                    </div>
                    <br>
                    <p class="custom-text text-center">{{ $user->email }}</p>
                    <div class="text-center p-5">
                        <a href="/profile" class="card-link custom-button">Modificar perfil</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 text-justify mb-4">
                <div class="card">
                    <div class="card-header"><h4>{{ __('Ultimos artículos') }}</h4></div>
                    <ul class="list-unstyled ml-2">
                        @forelse ($articles as $article)
                            <li class="pt-2">
                                <div class="row">
                                    <div class="col-8">
                                        <a href="/articles/{{ $article->id }}" class="card-link custom-text"><h5>{{ $article->title }}</h5></a>
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
                </div>
            </div>
        </div>
    </div>
@endsection
