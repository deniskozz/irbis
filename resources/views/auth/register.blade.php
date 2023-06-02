@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end" for="login">{{ __('Логин') }}</label>

                                <div class="col-md-6">
                                    <input autocomplete="login" autofocus
                                        class="form-control @error('login') is-invalid @enderror" id="login"
                                        name="login" required type="text" value="{{ old('login') }}">

                                    @error('login')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end"
                                    for="name">{{ __('Имя') }}</label>

                                <div class="col-md-6">
                                    <input autocomplete="name" autofocus
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" required type="text" value="{{ old('name') }}">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end"
                                    for="phone">{{ __('Телефон') }}</label>

                                <div class="col-md-6">
                                    <input autocomplete="phone" autofocus
                                        class="form-control @error('phone') is-invalid @enderror" id="phone"
                                        name="phone" required type="tel" value="{{ old('phone') }}">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end"
                                    for="email">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input autocomplete="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" required
                                        type="email" value="{{ old('email') }}">

                                    @error('email')
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
                                    <input autocomplete="new-password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        name="password" required type="password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end"
                                    for="password-confirm">{{ __('Подтвердите пароль') }}</label>

                                <div class="col-md-6">
                                    <input autocomplete="new-password" class="form-control" id="password-confirm"
                                        name="password_confirmation" required type="password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary" type="submit">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
