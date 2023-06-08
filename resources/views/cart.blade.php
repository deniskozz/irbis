@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($user)
            <h1>Корзина</h1>
            <!-- Отображение корзины для авторизованного пользователя -->
            @if (count($cartItems) == 0)
                <p>В корзине нет товаров</p>
            @else
                <form action="{{ route('order.place') }}" class="table-responsive update-form" method="POST">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-3">Название</th>
                                <th class="col-3 text-center">Количество</th>
                                <th class="col-2">Цена</th>
                                <th class="col-2">Сумма</th>
                                <th class="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $product)
                                <tr>
                                    <td class="col-3">{{ $product->name }}</td>
                                    <td class="col-3" style="text-align: center">
                                        <button class="minus-btn btn btn-default" onclick="decreaseQuantity(this)"
                                            type="button">-</button>
                                        <input class="product-quantity" name="newQuantity" type="text"
                                            value="{{ $product->pivot->amount }}">
                                        <input name="productId" type="hidden" value="{{ $product->id }}">
                                        <button class="plus-btn btn btn-default" onclick="increaseQuantity(this)"
                                            type="button">+</button>
                                    </td>
                                    <td class="col-2">{{ $product->pivot->price }} руб.</td>
                                    <td class="col-2 align-items-end product-sum">
                                        {{ $product->pivot->price * $product->pivot->amount }} руб.
                                    </td>
                                    <td class="col">
                                        <form action="{{ route('cart.delete', $product->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <input class="btn" type="submit" value="&#x2715">
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"><b>Итого:</b></td>
                                <td><b id="total">{{ $total }} руб.</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <input class="btn-gradient" type="submit" value="Оформить заказ">
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            @endif
        @else
            {{-- ------------------------------------------------------------------------------------------------------------------------------------------- --}}
            <!-- Отображение корзины для неавторизованного пользователя -->
            <div class="block-center">
                <p>Ваша корзина пуста.</p>
                <a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                    href="{{ route('catalog') }}">Перейти в каталог</a>
                <a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                    href="{{ route('login') }}">Войти для заказа</a>
            </div>
        @endif
    </div>


    <script src="{{ asset('public/js/cart.js') }}"></script>
@endsection
