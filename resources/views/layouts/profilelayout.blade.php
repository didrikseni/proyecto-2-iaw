@extends('layouts.app')

@section('content')
    <div class="container page-content">
        <div class="row p-3 justify-content-center">
            @yield('all_articles')
        </div>

        <div class="row pt-4">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="custom-text">{{ __('Perfil') }}</h4>
                    </div>
                    <div class="row pt-4">
                        @if ($user->avatar == null)
                            <i class="fas fa-user fa-5x col-auto ml-5 mr-3 mt-3 mb-5"></i>
                        @else
                            <img src="data:image/jpg;base64, {{ stream_get_contents($user->avatar) }}" style="border-radius:50%" class="centered-and-cropped col-auto ml-5 mr-3 mt-3 mb-2" width="100" height="100">
                        @endif
                        <p class="text-center col-auto custom-text mt-5 mb-2">{{ $user->name }}</p>
                    </div>
                    <hr>
                    <p class="custom-text text-center"> Email: {{ $user->email }}</p>
                    <p class="custom-text text-center"> Cantidad de artículos: {{ $user->articles->count() }}</p>
                    <p class="custom-text text-center"> Puntuación media: {{ $user->averageScore() }}</p>
                    <hr>

                    @if( auth()->id() == $user->id )
                        <div class="text-center p-5">
                            @yield('profile_link')
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-sm-8 text-justify mb-4">
                <div class="card">
                    @yield('card_header')
                    <ul class="list-unstyled ml-2">
                        @include('articles.articleList')
                    </ul>
                </div>
                <div class="row">
                    <div class="col-auto ml-auto">
                        <p>{{ $articles->links('layouts/customPaginationView') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
