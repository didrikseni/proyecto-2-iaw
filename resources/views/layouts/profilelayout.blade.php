@extends('layouts.app')

@section('content')
    <div class="container page-content">
        <div class="row p-3 justify-content-center">
            @yield('all_articles')
        </div>

        <div class="row pt-4">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header"><h4>{{ __('Perfil') }}</h4></div>
                    <div class="row justify-content-center pt-4">
                        @if ($user->avatar == null)
                            <i class="fas fa-user fa-5x col-2 m-5"></i>
                        @else
                            <img src="data:image/jpg;base64, {{ stream_get_contents($user->avatar) }}" style="border-radius:50%" class="centered-and-cropped" width="100" height="100">
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
                    @yield('articles_show')
                </div>
            </div>
        </div>
    </div>
@endsection
