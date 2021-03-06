@extends('layouts.app')

@section('head')
    <script src='https://cdn.tiny.cloud/1/3yn19ck0mgv6qus3qkej8vrfp9x3q45am4ikvprcke9nzs7q/tinymce/5/tinymce.min.js'
            referrerpolicy="origin"></script>
    <script src="{{ asset('js/stars.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            toolbar: false,
            menubar: false,
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            readonly: 1,
            plugins: ['autoresize'],
        });
    </script>
@endsection

@section('content')
    <div id="wrapper" class="page-content">
        <div id="page" class="container">
            <div class="row">
                <div class="ml-auto">
                    @auth
                    @if(auth()->id() != $article->user_id and auth()->user()->role != 'admin')
                        <div class="dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" onmousedown="animateCSS(this, 'bounceIn')"><i class="fas fa-ellipsis-h"></i></a>
                            <div class="dropdown-menu">
                                <form method="GET" action="/report/article/{{ $article->id }}" id="config-account">
                                    @csrf
                                    <button class="btn card-link dropdown-item"> Reportar publicación </button>
                                </form>
                            </div>
                        </div>
                    @endif
                    @endauth
                </div>
            </div>

            <div id="content flex">
                <div id="title" class="custom-text">
                    <h2>{{ $article->title }}</h2>
                </div>
                <div class="custom-text flex-grow-1">
                    <div class="flex-grow-1">
                        <textarea class="form-control flex-grow-1" type="text" name="content" id="content">{{ $article->content }}</textarea>
                    </div>
                    <br> <br>
                </div>
                @auth
                @if ($article->hasFile())
                    <div class="row custom-text mb-5">
                        <div class="col-9">
                            <p class="custom-text"> Archivo adjunto:
                                <a href="/article/files/{{ $article->getFile->id }}">{{ $article->getFile->name }}</a>
                            </p>
                        </div>
                    </div>
                @endif
                @endauth

                <div class="row custom-text">
                    <div class="ml-auto">
                        <h4> Autor:<a class="custom-text" href="/profile/{{ $article->user_id }}">{{ $article->author->name }}</a></h4>
                    </div>
                </div>

                <div class="row custom-text mb-5">
                    <p class="custom-text">tags:
                        @foreach($article->tags as $tag)
                            <a class="custom-text m-2" href="/tags/{{ $tag->id }}">{{ $tag->name }}</a>
                        @endforeach
                    </p>
                </div>

                @auth
                <div id="score" class="row custom-text mb-5">
                    @if(auth()->id() == $article->user_id or auth()->user()->role == 'admin')
                        <form method="GET" action="/articles/{{ $article->id }}/edit" class="ml-auto pr-5">
                            <button class="custom-button">Editar articulo</button>
                        </form>
                        <form method="POST" class="delete" action="/articles/{{ $article->id }}">
                            @csrf
                            @method('DELETE')
                            <button class="custom-button" onclick="return confirmDelete()">Borrar articulo</button>
                        </form>
                    @else
                        @if((\App\SavedArticle::alreadySaved($article)))
                            <div class="col-2 mr-auto">
                                <form method="POST" action="/article/bookmark/remove/{{ $article->id }}">
                                    @csrf
                                    <button class="custom-button row"><i class="fas fa-bookmark fa-lg"> Guardado</i></button>
                                </form>
                            </div>
                        @else
                            <div class="col-2 mr-auto">
                                <form method="POST" action="/article/bookmark/{{ $article->id }}">
                                    @csrf
                                    <button class="custom-button"><i class="far fa-bookmark fa-lg"> Guardar</i></button>
                                </form>
                            </div>
                        @endif
                        @if (\App\ArticleScore::hasVoted($article))
                            <div class="col-auto ml-auto">
                                <div class="row">
                                    <p class="mr-5 ">Tu voto:</p>
                                    <i class="far fa-star mx-2" id="star-1" style="font-size: 16px;"></i>
                                    <i class="far fa-star mx-2" id="star-2" style="font-size: 16px;"></i>
                                    <i class="far fa-star mx-2" id="star-3" style="font-size: 16px;"></i>
                                    <i class="far fa-star mx-2" id="star-4" style="font-size: 16px;"></i>
                                    <i class="far fa-star mx-2" id="star-5" style="font-size: 16px;"></i>
                                    <p id="vote-value" hidden>{{ (new \App\ArticleScore)->getVote($article) }}</p>
                                </div>
                                <script>
                                    for (let i = 1; i <= document.getElementById("vote-value").innerHTML; i++) {
                                        let item = document.getElementById("star-" + i);
                                        item.classList.remove('far');
                                        item.classList.add('fas');
                                    }
                                </script>
                            </div>
                        @else
                            <div class="col-auto ml-auto">
                                <p>Votar</p>
                            </div>
                            <div class="col-auto">
                                <form id="vote-form" method="POST" action="/articles/{{ $article->id }}/vote">
                                    @csrf
                                    <input name="form-value" type="hidden" id="form-value" value="0">
                                    <button id="star-1" onmouseover="stars(1)" class="custom-text transparent-btn" onmousedown="setSelected(1)"><i class="far fa-star"></i></button>
                                    <button id="star-2" onmouseover="stars(2)" class="custom-text transparent-btn" onmousedown="setSelected(2)"><i class="far fa-star"></i></button>
                                    <button id="star-3" onmouseover="stars(3)" class="custom-text transparent-btn" onmousedown="setSelected(3)"><i class="far fa-star"></i></button>
                                    <button id="star-4" onmouseover="stars(4)" class="custom-text transparent-btn" onmousedown="setSelected(4)"><i class="far fa-star"></i></button>
                                    <button id="star-5" onmouseover="stars(5)" class="custom-text transparent-btn" onmousedown="setSelected(5)"><i class="far fa-star"></i></button>
                                </form>
                            </div>
                        @endif
                    @endif
                </div>
                @endauth
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function confirmDelete() {
            return confirm("¿ Realmente desea borrar el artículo ?");
        }
    </script>
@endsection
