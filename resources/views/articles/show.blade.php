@extends('layouts.app')

@section('content')
    <div id="wrapper" class="page-content">
        <div id="page" class="container">
            <div id="content">
                <div id="title" class="custom-text">
                    <h2>{{ $article->title }}</h2>
                </div>
                <div class="custom-text">
                    {{ $article->content }}
                    <br> <br> <br> <br> <br>
                </div>
                <div id="score" class="row custom-text">

                    <div class="col-auto ml-auto">
                        <p>Votar</p>
                    </div>
                    <div class="col-auto">
                        <form id="vote-form" method="POST" action="/articles/{{ $article->id }}/vote">
                            @csrf
                            <input name="form-value" type="hidden" id="form-value" value="0">
                            <button value="1" id="star-1" onmouseover="stars(2)" class="custom-text transparent-btn"
                                    onmousedown="setSelected(1);submit()"><i class="far fa-star"></i></button>
                            <button value="2" id="star-2" onmouseover="stars(3)" class="custom-text transparent-btn"
                                    onmousedown="setSelected(2);submit()"><i class="far fa-star"></i></button>
                            <button value="3" id="star-3" onmouseover="stars(4)" class="custom-text transparent-btn"
                                    onmousedown="setSelected(3);submit()"><i class="far fa-star"></i></button>
                            <button value="4" id="star-4" onmouseover="stars(5)" class="custom-text transparent-btn"
                                    onmousedown="setSelected(4);submit()"><i class="far fa-star"></i></button>
                            <button value="5" id="star-5" onmouseover="stars(6)" class="custom-text transparent-btn"
                                    onmousedown="setSelected(5);submit()"><i class="far fa-star"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/stars.js') }}"></script>
@endsection
