@extends('layouts.app')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Номер заказа</th>
                <th>Пользователь</th>
                <th>Статус</th>
                <th>Дата создания</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>
                        <form action="{{ route('update_status', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select class="form-select" name="status" onchange="this.form.submit()">
                                <option {{ $order->status == 0 ? 'selected' : '' }} value="0">В обработке</option>
                                <option {{ $order->status == 1 ? 'selected' : '' }} value="1">Заказ принят</option>
                                <option {{ $order->status == 2 ? 'selected' : '' }} value="2">Заказ в пути</option>
                                <option {{ $order->status == 3 ? 'selected' : '' }} value="3">Доставлен</option>
                                <option {{ $order->status == 4 ? 'selected' : '' }} value="4">Отменен</option>
                            </select>
                        </form>
                    </td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('order_details', $order->id) }}">Просмотреть</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
