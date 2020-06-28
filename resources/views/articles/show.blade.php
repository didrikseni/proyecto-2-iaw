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
            <div id="content flex">
                <div id="title" class="custom-text">
                    <h2>{{ $article->title }}</h2>
                </div>
                <div class="custom-text flex-grow-1">
                    <div class="flex-grow-1">
                        <textarea class="form-control flex-grow-1" type="text" name="content"
                                  id="content">{{ $article->content }}</textarea>
                    </div>
                    <br> <br> <br> <br> <br>
                </div>
                <div id="score" class="row custom-text mb-5">
                    @if(auth()->id() == $article->user_id or auth()->user()->role == 'admin')
                        <form method="GET" action="/articles/{{ $article->id }}/edit" class="ml-auto pr-5">
                            <button class="custom-button">Editar articulo</button>
                        </form>
                        <form class="delete" action="/articles/{{ $article->id }}/delete" method="POST">
                            @csrf
                            <button class="custom-button" onclick="return confirmDelete()">Borrar articulo</button>
                        </form>
                    @else
                        <div class="col-auto mr-auto">
                            <h4>Autor: <a class="custom-text" href="/profile/{{ $article->user_id }}">{{ $article->author->name }}</a></h4>
                        </div>
                        @if ( \App\ArticleScore::hasVoted($article))
                            <div class="col-auto ml-auto">
                                <p>Tu voto:</p>
                                <button id="star-1" class="custom-text transparent-btn"><i class="far fa-star"></i>
                                </button>
                                <button id="star-2" class="custom-text transparent-btn"><i class="far fa-star"></i>
                                </button>
                                <button id="star-3" class="custom-text transparent-btn"><i class="far fa-star"></i>
                                </button>
                                <button id="star-4" class="custom-text transparent-btn"><i class="far fa-star"></i>
                                </button>
                                <button id="star-5" class="custom-text transparent-btn"><i class="far fa-star"></i>
                                </button>
                                <p id="vote-value"
                                   hidden>{{ auth()->user()->votes->where('article_id', '=', $article->id)->first()->vote }}</p>
                                <script>
                                    for (let i = 1; i <= document.getElementById("vote-value").innerHTML; i++) {
                                        let item = document.getElementById("star-" + i).firstChild;
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
                <div class="row">
                    <p class="custom-text">tags:
                        @foreach($article->tags as $tag)
                            <a class="custom-text m-2" href="/tags/{{ $tag->id }}">{{ $tag->name }}</a>
                        @endforeach
                    </p>
                </div>
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
