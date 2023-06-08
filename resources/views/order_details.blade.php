@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Детали заказа</h1>

        <p>Номер заказа: {{ $order->id }}</p>
        <p>Пользователь: {{ $order->user->name }}</p>
        <p>Телефон: {{ $order->user->phone }}</p>
        <p>Email: {{ $order->user->email }}</p>
        <p>Статус:
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
        </p>
        <p>Дата заказа: {{ $order->created_at->format('d m Y') }}</p>
        <div class="card">
            <div class="card-body">
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
@endsection
