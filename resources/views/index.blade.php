@extends('layouts.app')

@section('content')
    <div class="container py-2">
        <h1 class="text-center mt-3">Монтаж систем безопасности в Абакане</h1>
        <div class="promo mt-5 p-3">
            <div class="row align-items-center">
                <div class="col-sm-6 col-md-3 text-center justify-content-end d-flex flex-column align-items-center adv">
                    <img src="/public/img/prof.svg" alt="Профессионально" class="promo-image">
                    <h2 class="promo-title">Профессионально</h2>
                    <p class="promo-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="col-sm-6 col-md-3 text-center justify-content-end d-flex flex-column align-items-center adv">
                    <img src="/public/img/fast.svg" alt="Быстро" class="promo-image">
                    <h2 class="promo-title">Быстро</h2>
                    <p class="promo-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="col-sm-6 col-md-3 text-center justify-content-end d-flex flex-column align-items-center adv">
                    <img src="/public/img/secure.svg" alt="Безопасно" class="promo-image">
                    <h2 class="promo-title">Безопасно</h2>
                    <p class="promo-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="col-sm-6 col-md-3 text-center justify-content-end d-flex flex-column align-items-center adv">
                    <img src="/public/img/ok.svg" alt="Надежно" class="promo-image">
                    <h2 class="promo-title">Надежно</h2>
                    <p class="promo-description">Lorem ipsum dolor sit ametLorem ipsum dolor sit amet, consectetur
                        adipiscing elit.</p>
                </div>
            </div>

            <div class="row">
                <div class="divider my-2"></div>
            </div>
            <div class="row p-3 pt-4 pb-4">
                <form action="{{ route('callback') }}" method="post"
                    class="callback-form d-flex justify-content-between row-cols-3">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" id="name" placeholder="Ваше имя"
                            class="callback-form__input @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" id="phone" placeholder="Ваш телефон"
                            class="callback-form__input  @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                            required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="submit" value="Оставить заявку" class=" callback-form__btn ">
                </form>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
        </div>


        <div class="benefits">
            <h2 class="text-center mt-5">Зачем вам нужны системы безопасности</h2>
            <div class="row row-cols-3 d-flex justify-content-between">
                <div class="benefit col-4">
                    <div class="benefit-inner" id="benefit1">
                    </div>
                </div>
                <div class="benefit col-4">
                    <div id="benefit2" class="benefit-inner">
                    </div>
                </div>
                <div class="benefit col-4">
                    <div class="benefit-inner" id="benefit3">
                    </div>
                </div>
            </div>
            <div class="row row-cols-2 d-flex justify-content-between">
                <div class="benefit w-no col">
                    <div id="benefit4" class="benefit-inner">
                    </div>
                </div>
                <div class="benefit w-no col">
                    <div id="benefit5" class="benefit-inner">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
