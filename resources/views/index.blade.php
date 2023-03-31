@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-3">Installation of Video Surveillance Systems in Abakan</h1>
    <div class="container py-2">
        <div class="promo mt-5 p-3">
            <div class="row">
                <div class="col-sm-6 col-md-3 text-center justify-content-end d-flex flex-column align-items-center">
                    <img src="/public/img/prof.svg" alt="Профессионально" class="promo-image">
                    <h2 class="promo-title">Профессионально</h2>
                    <p class="promo-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="col-sm-6 col-md-3 text-center justify-content-end d-flex flex-column align-items-center">
                    <img src="/public/img/fast.svg" alt="Быстро" class="promo-image">
                    <h2 class="promo-title">Быстро</h2>
                    <p class="promo-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="col-sm-6 col-md-3 text-center justify-content-end d-flex flex-column align-items-center">
                    <img src="/public/img/secure.svg" alt="Безопасно" class="promo-image">
                    <h2 class="promo-title">Безопасно</h2>
                    <p class="promo-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="col-sm-6 col-md-3 text-center justify-content-end d-flex flex-column align-items-center">
                    <img src="/public/img/ok.svg" alt="Надежно" class="promo-image">
                    <h2 class="promo-title">Надежно</h2>
                    <p class="promo-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="row">
                <div class="divider my-2"></div>
            </div>
            <div class="row">
                <form action="{{ route('callback') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
            </div>
        </div>
    </div>
@endsection
