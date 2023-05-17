@extends('layouts.app')

@section('content')
    <div class="container py-2">
        <h1 class="text-center mt-3">Монтаж систем безопасности в Абакане</h1>
        <div class="promo mt-5 p-3">
            <div class="row align-items-center">
                <div class="col-sm-6 col-md-4 text-center justify-content-end d-flex flex-column align-items-center adv">
                    <img src="/public/img/prof.svg" alt="Профессионально" class="promo-image">
                    <h2 class="promo-title">Профессионально</h2>
                    <p class="promo-description">Более 3х лет работы у каждого мастера</p>
                </div>
                <div class="col-sm-6 col-md-4 text-center justify-content-end d-flex flex-column align-items-center adv">
                    <img src="/public/img/fast.svg" alt="Быстро" class="promo-image">
                    <h2 class="promo-title">Быстро</h2>
                    <p class="promo-description">Максимально быстрый расчёт, проектирование и монтаж</p>
                </div>
                {{-- <div class="col-sm-6 col-md-3 text-center justify-content-end d-flex flex-column align-items-center adv">
                    <img src="/public/img/secure.svg" alt="Безопасно" class="promo-image">
                    <h2 class="promo-title">Безопасно</h2>
                    <p class="promo-description">Защита вас и ваших данных </p>
                </div> --}}
                <div class="col-sm-6 col-md-4 text-center justify-content-end d-flex flex-column align-items-center adv">
                    <img src="/public/img/ok.svg" alt="Надежно" class="promo-image">
                    <h2 class="promo-title">Качественно</h2>
                    <p class="promo-description">Соответствуем требованиям и стандартам качества</p>
                </div>
            </div>

            <div class="row">
                <div class="divider my-2"></div>
            </div>
            <div class="row p-3 pt-4 pb-4">
                <form action="{{ route('callback') }}" method="post"
                    class="callback-form d-flex justify-content-between flex-column flex-md-row row-cols-3">
                    @csrf
                    <div class="form-group col-12 col-md-3">
                        <input type="text" name="name" id="name" placeholder="Ваше имя"
                            class="w-100 callback-form__input @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-md-3 mt-3 mt-md-0">
                        <input type="text" name="phone" id="phone" placeholder="Ваш телефон"
                            class="w-100 callback-form__input  @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                            required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-md-3 mt-3 mt-md-0">
                        <input type="submit" value="Оставить заявку" class="w-100 callback-form__btn ">
                    </div>
                </form>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
        </div>

        <div class="sales_unit mb-2 mb-md-5">
            <div class="row">
                <div class="col-sm-6 col-md-6 text-side">
                    <p>Наша компания предлагает профессиональную установку видеонаблюдения для бизнеса и дома. Мы используем
                        высококачественное оборудование и настраиваем систему под потребности клиента. Наши специалисты
                        обладают большим опытом и быстро монтируют систему. Мы гарантируем безопасность вашего имущества и
                        защиту от краж и вандализма</p>
                </div>
                <div class="col-sm-6 col-md-6 img-side">
                    <img src="/public/img/man.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>

        <div class="benefits">
            <h2 class="text-center">Зачем вам нужны системы безопасности</h2>
            <div class="row">
                <div class="grid mt-3 col-md-4">
                    <figure class="effect-sadie">
                        <img src="/public/img/ben1.png" alt="img02" />
                        <figcaption>
                            <h2>Защита материальных<span> ценностей</span></h2>
                            <p>обеспечение сохранности имущества от возможных угроз и нежелательных событий.</p>
                        </figcaption>
                    </figure>
                </div>
                <div class="grid mt-3 col-md-4">
                    <figure class="effect-sadie">
                        <img src="/public/img/ben2.png" alt="img02" />
                        <figcaption>
                            <h2><span>Доказательная база</span><br> в случае правонарушений</h2>
                            <p>наличие информации и фактов, подтверждающих действия нарушителей и преступников.</p>
                        </figcaption>
                    </figure>
                </div>
                <div class="grid mt-3 col-md-4">
                    <figure class="effect-sadie">
                        <img src="/public/img/ben4.png" alt="img02" />
                        <figcaption>
                            <h2>Снижение <span> расходов </span> на безопасность </h2>
                            <p>модернизация охранной инфраструктуры может существенно повысить эффективность ее работы и
                                сократить затраты.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div class="row mt-3">

                <div class="grid mt-3 col-md-6">
                    <figure class="effect-sadie">
                        <img src="/public/img/ben3.png" alt="img02" />
                        <figcaption>
                            <h2>Повышение трудовой <span>дисциплины</span></h2>
                            <p>формирование ответственного отношения к соблюдению правил и режима работы, улучшение контроля
                                и координации действий сотрудников.</p>
                        </figcaption>
                    </figure>
                </div>
                <div class="grid mt-3 col-md-6">
                    <figure class="effect-sadie">
                        <img src="/public/img/ben5.png" alt="img02" />
                        <figcaption>
                            <h2>Контроль зон повышенного <span> риска</span></h2>
                            <p>мониторинг и анализ состояния территории и обстановки вокруг, принятие мер по предотвращению
                                угроз и рисков.</p>
                        </figcaption>
                    </figure>
                </div>

            </div>
        </div>


    </div>
@endsection
