@extends('layouts.app')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                <div id="title">
                    <h2>{{ $article->title }}</h2>
                </div>

                {{ $article->content }}

                <div id="score" class="row">
                    <div class="col-4">
                        <h4>{{ $article->score }}</h4>
                    </div>
                    <div class="col-auto">
                        <p>Votar</p>
                        <i class="far fa-star" onmouseover="c"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
