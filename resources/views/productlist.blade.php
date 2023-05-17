@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach ($products as $product)
            <div class="row flex-row row-list">
                <div class="col">
                    <p><strong>Описание:</strong> {{ $product->description }}</p>
                </div>
                <div class="col">
                    <p><strong>Цена:</strong> {{ $product->price }}</p>
                </div>
                <div class="col"><img alt="" class="card-image" src="{{ Storage::url($product->img) }} "
                        width="150"></div>
                <div class="col">
                    <form action="/admin/destroy/{{ $product->id }}" method="post">
                        <input class="btn btn-danger" type="submit" value="Удалить">
                        @csrf
                    </form>
                </div>
                <div class="col">
                    <a href="{{ route('editproduct', ['id' => $product->id]) }}">Редактировать</a>
                </div>
            </div>
        @endforeach
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endsection
