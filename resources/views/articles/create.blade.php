@extends('layouts.edittext')

@section('content')
    <div class="page-content">
        <div class="container">
            <h1 class="">Nuevo Artículo</h1>
            <form method="POST" action="/articles" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="label" for="title">Título</label>
                    <div>
                        <input class="input-group form-control @error('title') alert-danger @enderror" type="text"
                               name="title" id="title" value="{{ old('title') }}">
                        @error('title')
                        <p class="badge badge-danger">{{ $errors->first('title') }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="label" for="description">Descripción</label>
                    <div>
                        <input class="input-group form-control @error('description') alert-danger @enderror" type="text"
                               name="description" id="description" value="{{ old('description') }}">
                        @error('description')
                        <p class="badge badge-danger">{{ $errors->first('title') }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="label" for="content">Contenido</label>
                    <div>
                        <textarea class="form-control form-control" type="text" name="content" id="content" rows="20">{{ old('content') }}</textarea>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-auto">
                        <span class="input-files" hidden>
                            <input type="file" id="input-files" name="file" accept="application/pdf">
                        </span>
                        <label for="input-files" class="custom-button"><span>Adjuntar archivo</span></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-auto">
                        <div></div>
                    </div>
                    <div class="col-auto"></div>
                </div>

                <div class="form-group">
                    <label class="label" for="tags">Tags</label>
                    <div class="input-group">
                        <select class="custom-select" name="tags[]" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                        <p class="badge badge-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <br>
                <div class="form-group row justify-content-end">
                    <div class="col-auto">
                        <button class="custom-button">Publicar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script> src="{{ asset('js/createBladeLogic.js') }}" </script>
@endsection
