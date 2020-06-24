@extends('layouts.app')

@section('content')
    <div class="container page-content mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-header">{{ __('Configuración') }}</div>
                    <div class="card-body">

                        <form method="POST" action="/profile">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="custom-button">{{ __('Guardar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <br>

                <div class="card">
                    <div class="card-header">{{ __('Cambiar avatar') }}</div>
                    <div class="card-body">

                        <form method="POST" action="/profile/avatar">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <img id="avatar" class="centered-and-cropped" width="200" height="200"
                                         style="border-radius:50%" src="#" name="avatar" hidden/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="col-auto">
                                        <span class="custom-input" hidden>
                                            <input type="file" id="custom-input" name="filename" accept="image/*" onchange="readURL(this);">
                                        </span>
                                        <label for="custom-input" class="custom-button"><span>Seleccionar imagen</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="custom-button">{{ __('Guardar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><br>

                <div class="card">
                    <div class="card-header">{{ __('Cambiar contraseña') }}</div>
                    <div class="card-body">

                        <form method="POST" action="/profile/password">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="current_password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Contraseña actual') }}</label>
                                <div class="col-md-6">
                                    <input id="current_password" type="password"
                                           class="form-control @error('current-password') is-invalid @enderror"
                                           name="current_password" required autocomplete="new-password">
                                    @error('current-password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Nueva contraseña') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new_password">
                                </div>
                            </div>

                            <div class="form-group row mb">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="custom-button">{{ __('Guardar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#avatar').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
                document.getElementById('avatar').hidden = false;
            }
        }
    </script>
@endsection
