@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Корзина</h1>
        @if (count($cart) == 0)
            <p>Корзина пуста</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Количество</th>
                        <th>Цена</th>
                        <th>Сумма</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $product)
                        <tr>
                            <td>{{ $product['name'] }}</td>
                            <td style="text-align: center">
                                <form action="/cart/update" class="update-form" method="POST">
                                    @csrf
                                    <input name="product_id" type="hidden" value="{{ $product['id'] }}">
                                    <button class="minus-btn btn btn-default" type="button">-</button>
                                    <input class="product-quantity" name="newQuantity" type="text"
                                        value="{{ $product['quantity'] }}">
                                    <button class="plus-btn btn btn-default" type="button">+</button>
                                    <button class="update-btn btn btn-primary" type="submit">Update</button>
                                </form>
                            </td>
                            <td>{{ $product['price'] }} руб.</td>
                            <td class="product-sum">{{ $product['price'] * $product['quantity'] }} руб.</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"><b>Итого:</b></td>
                        <td><b>{{ $total }} руб.</b></td>
                    </tr>
                </tbody>
            </table>
            <a class="btn btn-primary" href="">Оформить заказ</a>
        @endif
    </div>


    <script src="{{ asset('public/js/cart.js') }}"></script>
@endsection
