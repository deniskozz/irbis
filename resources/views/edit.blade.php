@extends('layouts.app')

@section('content')
    <div class="container pb-5">
        <h1>Редактировать продукт</h1>
        <form action="{{ route('updateproduct', $product->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            <label for="name">Название:</label><br>
            <input class="w-50" name="name" type="text" value="{{ $product->name }}"><br><br>
            <label for="category">Категория:</label><br>
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}
                    </option>
                @endforeach
            </select><br><br>
            <label for="description">Описание:</label><br>
            <textarea class="w-100" name="description">{{ $product->description }}</textarea><br><br>
            <label for="parameters">Описание:</label><br>
            <textarea class="w-100" name="parameters">{{ $product->parameters }}</textarea><br><br>
            <label for="price">Цена:</label><br>
            <input name="price" type="number" value="{{ $product->price }}"><br><br>
            <label for="img">Изображение:</label><br>
            <input name="img" type="file"><br><br>
            <button type="submit">Сохранить изменения</button>
        </form>
    </div>
@endsection
