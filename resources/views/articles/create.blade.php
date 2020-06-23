@extends('layouts.edittext')

@section('content')
    <div class="page-content">
        <div class="container">
            <h1 class="">Nuevo Artículo</h1>
            <form method="POST" action="/articles">
                @csrf
                <div class="form-group">
                    <label class="label" for="title">Título</label>
                    <div>
                        <input class="input-group form-control @error('title') alert-danger @enderror" type="text" name="title" id="title" value="{{ old('title') }}">
                        @error('title')
                        <p class="badge badge-danger">{{ $errors->first('title') }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="label" for="description">Descripción</label>
                    <div>
                        <input class="input-group form-control @error('description') alert-danger @enderror" type="text" name="description" id="description" value="{{ old('description') }}">
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
                        <span class="custom-input" hidden>
                            <input type="file" id="custom-input" name="filename" accept="application/pdf" multiple>
                        </span>
                        <label for="custom-input"><span>Adjuntar archivo</span></label>
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
    <script type="application/javascript">
        jQuery('input[type=file]').change(function(){
            var filename = jQuery(this).val().split('\\').pop();
            var idname = jQuery(this).attr('id');
            console.log(jQuery(this));
            console.log(filename);
            console.log(idname);
            jQuery('span.'+idname).next().find('span').html(filename);
        });
    </script>
@endsection
