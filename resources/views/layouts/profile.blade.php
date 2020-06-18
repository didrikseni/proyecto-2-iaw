@extends('layouts.app')

@section('content')
    <div class="page-content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-sm-5">
            <h2 class="text-justify">Perfil</h2>
            <div class="row">
                <i class="fas fa-user fa-5x col-2"></i>
                <p class="text-center col-3 custom-text">{{ $user->name }}</p>
            </div>
            <br>
            <p class="custom-text">{{ $user->email }}</p>
        </div>
    </div>
@endsection
