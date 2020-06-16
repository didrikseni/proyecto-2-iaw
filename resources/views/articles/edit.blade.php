@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container">
            <h1 class="">Editor de artículo</h1>

            <form method="POST" action="/articles/{{ $article->id }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="label" for="title">Editar título</label>
                    <div>
                        <input class="input-group" type="text" name="title" id="title" value="{{ $article->title }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="label" for="description">Editar descripción</label>
                    <div>
                        <input class="input-group" type="text" name="description" id="description"  value="{{ $article->description }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="label" for="content">Editar contenido</label>
                    <div >
                        <textarea class="form-control" type="text" name="content" id="content" rows="8">{{ $article->content }}</textarea>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-auto">
                        <button class="btn btn-secondary">Subir archivo</button>
                    </div>

                    <div class="col-auto">
                        <button class="btn btn-secondary">Subir imagen</button>
                    </div>
                </div>
                <br>
                <div class="form-group row justify-content-end">
                    <div class="col-auto">
                        <button class="btn btn-secondary">Publicar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
