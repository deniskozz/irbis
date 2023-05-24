@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Корзина</h1>
        @if ($user)
            <!-- Display cart for authenticated user -->
            <h3>Authenticated User Cart</h3>
            <!-- Add your authenticated user cart display logic here -->
            <form action="/cart/update" class="update-form" method="POST">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-4">Название</th>
                            <th class="col-3 text-center">Количество</th>
                            <th class="col-2">Цена</th>
                            <th class="col-3">Сумма</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $product)
                            <tr>
                                <td class="col-4">{{ $product->name }}</td>
                                <td class="col-3" style="text-align: center">
                                    @csrf
                                    <input name="product_id" type="hidden" value="{{ $product->id }}">
                                    <button class="minus-btn btn btn-default" onclick="decreaseQuantity(this)"
                                        type="button">-</button>
                                    <input class="product-quantity" name="newQuantity" type="text"
                                        value="{{ $product->pivot->amount }}">
                                    <button class="plus-btn btn btn-default" onclick="increaseQuantity(this)"
                                        type="button">+</button>
                                </td>
                                <td class="col-2">{{ $product->pivot->price }} руб.</td>
                                <td class="col-3 align-items-end product-sum">
                                    {{ $product->pivot->price * $product->pivot->amount }} руб.</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="3"><b>Итого:</b></td>
                            <td><b id="total">{{ $total }} руб.</b></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <input type="submit" value="Оформить заказ">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        @else
            <!-- Display cart for guest user -->
            <h3>Guest User Cart</h3>
            <!-- Add your guest user cart display logic here -->
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-4">Название</th>
                        <th class="col-3 text-center">Количество</th>
                        <th class="col-2">Цена</th>
                        <th class="col-3">Сумма</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $product)
                        <tr>
                            <td class="col-4">{{ $product['name'] }}</td>
                            <td class="col-3" style="text-align: center">
                                <input name="product_id" type="hidden" value="{{ $product['id'] }}">
                                <button class="minus-btn btn btn-default" onclick="decreaseQuantity(this)"
                                    type="button">-</button>
                                <input class="product-quantity" name="newQuantity" type="text"
                                    value="{{ $product['quantity'] }}">
                                <button class="plus-btn btn btn-default" onclick="increaseQuantity(this)"
                                    type="button">+</button>
                            </td>
                            <td class="col-2">{{ $product['price'] }} руб.</td>
                            <td class="col-3 align-items-end product-sum">
                                @php
                                    $subtotal = $product['price'] * $product['quantity'];
                                @endphp
                                {{ $subtotal }} руб.
                            </td>
                        </tr>
                    @endforeach



                    <tr>
                        <td colspan="3"><b>Итого:</b></td>
                        <td><b id="total">{{ $total }} руб.</b></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <a class="btn btn-primary" href="{{ route('login') }}">Войти для оформления заказа</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>

    <script src="{{ asset('public/js/cart.js') }}"></script>
@endsection
