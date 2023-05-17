@extends('layouts.app')

@section('content')
    <h1>Создать продукт</h1>
    <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="name">Категория</label>
            <input type="number" name="category" id="name" class="form-control" value="" required>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="description">картинка</label>
            <input type="file" name="img" id="">
        </div>
        <div class="form-group">
            <label for="price">Цена</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}"
                step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
        <a href="{{ route('create') }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection
