@extends('layouts.app')

@section('head')
    <script src='https://cdn.tiny.cloud/1/3yn19ck0mgv6qus3qkej8vrfp9x3q45am4ikvprcke9nzs7q/tinymce/5/tinymce.min.js'
            referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            toolbar: false,
            menubar: false,
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            readonly: 1,
        });
    </script>
@endsection


@section('content')
    <div id="wrapper" class="page-content">
        <div id="page" class="container">
            <div id="content">
                <div id="title" class="custom-text">
                    <h2>{{ $article->title }}</h2>
                </div>
                <div class="custom-text">
                    <div>
                        <textarea class="form-control" type="text" name="content" id="content"
                                  rows="20">{{ $article->content }}</textarea>
                    </div>

                    <br> <br> <br> <br> <br>
                </div>
                <div id="score" class="row custom-text mb-5">
                    @if(auth()->id() == $article->id)
                        <form method="GET" action="/articles/{{ $article->id }}/edit" class="ml-auto">
                            <button class="btn btn-secondary">Editar articulo</button>
                        </form>
                    @else
                        <div class="col-auto mr-auto">
                            <h4>Autor: <a class="custom-text"
                                          href="/profile/{{ (\App\User::find($article->user_id))->id }}">
                                    {{ (\App\User::find($article->user_id))->name }}
                                </a></h4>
                        </div>
                        @if ( (new \App\ArticleScore)->hasVoted($article) )
                            <div class="col-auto ml-auto">
                                <p>Tu voto: {{ (new \App\ArticleScore)->getVote($article) }}</p>
                            </div>
                        @else
                            <div class="col-auto ml-auto">
                                <p>Votar</p>
                            </div>
                            <div class="col-auto">
                                <form id="vote-form" method="POST" action="/articles/{{ $article->id }}/vote">
                                    @csrf
                                    <input name="form-value" type="hidden" id="form-value" value="0">
                                    <button id="star-1" onmouseover="stars(1)" class="custom-text transparent-btn"
                                            onmousedown="setSelected(1)"><i class="far fa-star"></i></button>
                                    <button id="star-2" onmouseover="stars(2)" class="custom-text transparent-btn"
                                            onmousedown="setSelected(2)"><i class="far fa-star"></i></button>
                                    <button id="star-3" onmouseover="stars(3)" class="custom-text transparent-btn"
                                            onmousedown="setSelected(3)"><i class="far fa-star"></i></button>
                                    <button id="star-4" onmouseover="stars(4)" class="custom-text transparent-btn"
                                            onmousedown="setSelected(4)"><i class="far fa-star"></i></button>
                                    <button id="star-5" onmouseover="stars(5)" class="custom-text transparent-btn"
                                            onmousedown="setSelected(5)"><i class="far fa-star"></i></button>
                                </form>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/stars.js') }}"></script>
@endsection
