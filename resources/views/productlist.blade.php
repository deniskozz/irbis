@extends('layouts.app')
@section('content')
<div class="container">
    @foreach ($products as $product)
    <div class="row flex-row row-list">
        <div class="col"><p><strong>Описание:</strong> {{ $product->description }}</p></div>
        <div class="col"><p><strong>Цена:</strong> {{ $product->price }}</p></div>
        <div class="col"><img width="150" class="card-image" src="{{ Storage::url($product->img) }} " alt=""></div>
        <div class="col">
            <form action="/admin/destroy/{{$product->id}}" method="post">
                <input type="submit" class="btn btn-danger" value="Удалить">
                @csrf
            </form>
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
