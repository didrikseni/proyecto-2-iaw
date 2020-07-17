@extends('layouts.profilelayout')

@section('card_header')
    <div class="card-header"><h4>{{ __('Publicaciónes') }}</h4></div>
@endsection

@section('profile_link')
    <a href="/article/bookmark" class="card-link custom-button">Ver guardados</a>
    <br>
    <a href="/profile" class="card-link custom-button mt-4">Modificar perfil</a>
@endsection

