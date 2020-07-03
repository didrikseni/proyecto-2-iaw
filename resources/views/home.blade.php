@extends('layouts.profilelayout')

@section('all_articles')
    <div class="card row">
        <div>
            <a href="/articles" class="card-link custom-button text-uppercase">Todos los artículos</a>
        </div>
    </div>
@endsection

@section('card_header')
    <div class="card-header"><h4>{{ __('Ultimos artículos') }}</h4></div>
@endsection

@section('profile_link')
    <a href="/profile/{{ $user->id }}" class="card-link custom-button">Ver perfil</a>
@endsection
