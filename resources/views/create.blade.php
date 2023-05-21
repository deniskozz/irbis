@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Создать продукт</h1>
        <form action="{{ route('store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <input class="form-control" id="name" name="name" required type="text" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="name">Категория</label>
                {{-- поменять на селект --}}
                <input class="form-control" id="name" name="category_id" required type="number" value="">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" id="description" name="description" required rows="3">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="description">картинка</label>
                <input id="" name="img" type="file">
            </div>
            <div class="form-group">
                <label for="price">Цена</label>
                <input class="form-control" id="price" name="price" required step="0.01" type="number"
                    value="{{ old('price') }}">
            </div>
            <button class="btn btn-primary" type="submit">Создать</button>
            <a class="btn btn-secondary" href="{{ route('create') }}">Отмена</a>
        </form>
    </div>
@endsection
