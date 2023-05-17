@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="breadcrumb">
            <a href="/catalog">Каталог</a>/<a href="{{ url()->previous() }}">{{$currentProduct->category->name}}</a>

            <p>{{$currentProduct->name}}</p>
        </div>
    </div>
@endsection