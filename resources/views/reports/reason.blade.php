@extends('layouts.app')


@section('content')
<div class="page-content container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Seleccione el motivo de la denuncia</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/report/article/{{ $article->id }}">
                    @csrf
                    @foreach(\App\ArticlesReports::getAllReasons() as $reason)
                        <div class="form-check ml-5 mr-5 mt-3 mb-3">
                            <input class="form-check-input" type="radio" name="reason" id="{{ $reason }}" value="{{ $reason }}" checked>
                            <label class="form-check-label" for="{{ $reason }}" style="cursor:pointer">
                                <h5 class="card-group custom-text">{{ $reason }}</h5>
                            </label>
                        </div>
                    @endforeach
                    <div class="text-center mt-5">
                        <button class="custom-button">Denunciar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
