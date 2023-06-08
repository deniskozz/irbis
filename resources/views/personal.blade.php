@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Личный кабинет</h1>

        <div id="accordion">

            <div class="card">
                <div class="card-header" id="ordersHeading">
                    <h2 class="mb-0">
                        <button aria-controls="ordersCollapse" aria-expanded="true" class="btn w-100 btn-link collapse-link"
                            data-target="#ordersCollapse" data-toggle="collapse" style="text-align: left" type="button">
                            Список заказов
                        </button>
                    </h2>
                </div>
                <div aria-labelledby="ordersHeading" class="collapse" data-parent="#accordion" id="ordersCollapse">
                    <div class="card-body">
                        @foreach ($orders as $order)
                            <div class="card mb-3">
                                <div class="card-header" id="orderHeading{{ $order->id }}">
                                    <h3 class="mb-0">
                                        <button aria-controls="orderCollapse{{ $order->id }}" aria-expanded="true"
                                            class="btn btn-link w-100 text-left"
                                            data-target="#orderCollapse{{ $order->id }}" data-toggle="collapse">
                                            Дата заказа: {{ $order->created_at->format('d:m:Y') }}
                                            <span style="display: inline-block">Статус:
                                                @if ($order->status == 0)
                                                    <span class="text-body-secondary">В обработке</span>
                                                @elseif ($order->status == 1)
                                                    <span class="text-success-emphasis">Заказ принят</span>
                                                @elseif ($order->status == 2)
                                                    Заказ в пути
                                                @elseif ($order->status == 3)
                                                    <span class="text-success">Доставлен</span>
                                                @elseif ($order->status == 4)
                                                    <span class="text-danger">Отменен</span>
                                                @endif
                                            </span>
                                        </button>
                                    </h3>
                                </div>
                                <div aria-labelledby="orderHeading{{ $order->id }}" class="collapse"
                                    data-parent="#ordersCollapse" id="orderCollapse{{ $order->id }}">
                                    <div class="card-body table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Товар</th>
                                                    <th>Количество</th>
                                                    <th>Цена</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $totalPrice = 0;
                                                @endphp
                                                @foreach ($order->cart->products as $product)
                                                    <tr>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->pivot->amount }}</td>
                                                        <td>{{ $product->pivot->amount * $product->pivot->price }}</td>
                                                    </tr>
                                                    @php
                                                        $totalPrice += $product->pivot->amount * $product->pivot->price;
                                                    @endphp
                                                @endforeach
                                                <tr class="total-price">
                                                    <td colspan="2">Итого:</td>
                                                    <td>{{ $totalPrice }} руб.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="profileHeading">
                    <h2 class="mb-0">
                        <button aria-controls="profileCollapse" aria-expanded="false"
                            class="btn w-100 btn-link collapse-link collapsed" data-target="#profileCollapse"
                            data-toggle="collapse" style="text-align: left" type="button">
                            Профиль
                        </button>
                    </h2>
                </div>
                <div aria-labelledby="profileHeading" class="collapse" data-parent="#accordion" id="profileCollapse">
                    <div class="card-body">
                        <form action="{{ route('updateProfile') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input class="form-control" id="name" name="name" type="text"
                                    value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Номер телефона</label>
                                <input class="form-control" id="phone" name="phone" type="tel"
                                    value="{{ $user->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="email"
                                    value="{{ $user->email }}">
                            </div>
                            <button class="btn-gradient mt-3" type="submit">Обновить данные</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="passwordHeading">
                    <h2 class="mb-0">
                        <button aria-controls="passwordCollapse" aria-expanded="false"
                            class="btn w-100 btn-link collapse-link collapsed" data-target="#passwordCollapse"
                            data-toggle="collapse" style="text-align: left" type="button">
                            Изменить пароль
                        </button>
                    </h2>
                </div>
                <div aria-labelledby="passwordHeading" class="collapse" data-parent="#accordion" id="passwordCollapse">
                    <div class="card-body">
                        <form action="{{ route('changePassword') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="current_password">Текущий пароль</label>
                                <input class="form-control" id="current_password" name="current_password"
                                    type="password">
                            </div>
                            <div class="form-group">
                                <label for="new_password">Новый пароль</label>
                                <input class="form-control" id="new_password" name="new_password" type="password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Повторите пароль</label>
                                <input class="form-control" id="confirm_password" name="confirm_password"
                                    type="password">
                            </div>
                            <button class="btn-gradient mt-3" type="submit">Изменить пароль</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
