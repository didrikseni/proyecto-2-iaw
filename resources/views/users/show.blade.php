@extends('layouts.profile')

@section('content')
    <div class="container page-content">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-sm-5 card">
                <h2>Perfil</h2>
                <div class="row">
                    <div class="col-2 ml-3">
                        <i class="fas fa-user fa-5x"></i>
                    </div>
                    <div class="col-auto">
                        <p class="col-auto custom-text">{{ $user->name }}</p>
                    </div>
                </div>
                <br>
                <p class="custom-text text-center">{{ $user->email }}</p>
            </div>
            <div class="col-sm-7 text-justify card">
                <h2>Ultimos posts</h2>
                <hr>
                <ul class="list-unstyled ml-2">
                    @foreach($articles as $article)
                        <li>
                            <a href="/articles/{{ $article->id }}"><h4>{{ $article->title }}</h4></a>
                            <p>{{ $article->description }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
