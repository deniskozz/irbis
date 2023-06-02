@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Войти') }}</div>

                    <div class="card-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end" for="login">{{ __('Логин') }}</label>

                                <div class="col-md-6">
                                    <input autocomplete="login" autofocus
                                        class="w-100 callback-form__input form-control @error('login') is-invalid @enderror"
                                        id="login" name="login" required type="text" value="{{ old('login') }}">

                                    @error('login')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end"
                                    for="password">{{ __('Пароль') }}</label>

                                <div class="col-md-6">
                                    <input autocomplete="current-password"
                                        class="w-100 callback-form__input form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" required type="password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input {{ old('remember') ? 'checked' : '' }} class="form-check-input"
                                            id="remember" name="remember" type="checkbox">

                                        <label class="form-check-label" for="remember">
                                            {{ __('Запомнить меня') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button class="btn-gradient w-75" type="submit">
                                        {{ __('Войти') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link " href="{{ route('password.request') }}">
                                            {{ __('Забыли пароль?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
