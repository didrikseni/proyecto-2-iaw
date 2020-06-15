@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container">
            <h1 class="">Nuevo Artículo</h1>

            <form>
                <div class="form-group">
                    <label class="label" for="title">Título</label>
                    <div>
                        <input class="input-group" type="text" name="title" id="title">
                    </div>
                </div>

                <div class="form-group">
                    <label class="label" for="description">Descripción</label>
                    <div>
                        <input class="input-group" type="text" name="description" id="description">
                    </div>
                </div>

                <div class="form-group">
                    <label class="label" for="content">Contenido</label>
                    <div >
                        <textarea class="form-control" type="text" name="content" id="content" rows="8"></textarea>
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

                    <div class="col-auto">
                        <button class="btn btn-secondary">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
