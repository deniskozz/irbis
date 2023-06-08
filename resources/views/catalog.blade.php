@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('search') }}" class="input-group pb-4" method="GET">
                <input class="form-control" name="search" placeholder="Найти товар" type="text">
                <input class="btn btn-outline-dark" type="submit" value="Найти">
            </form>
            <div class="col-md-3">
                <div class="mb-3">
                    <ul class="list-group list-group-flush">
                        @foreach ($rootCategories as $rootCategory)
                            <li class="catalog-link root-link">
                                <a href="/catalog/{{ $rootCategory->id }}">{{ $rootCategory->name }}</a>
                            </li>
                            @if ($rootCategory->SubCategory->count() > 0)
                                @include('layouts.treeChildMenu', [
                                    'categories' => $rootCategory->SubCategory ?? [],
                                ])
                            @endif
                            <div class="divider-line"></div>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4 mb-3">
                            <div class="product-card">
                                <a class="card-link" href="/catalog/{{ $product->Category->id }}/{{ $product->id }}">
                                    <div class="product-tumb">
                                        <img alt="" src="{{ Storage::url($product->img) }}">
                                    </div>
                                </a>
                                <div class="product-details">
                                    <a class="card-link" href="/catalog/{{ $product->Category->id }}/{{ $product->id }}">
                                        <h4>{{ $product->name }}</h4>
                                    </a>
                                    <div class="product-bottom-details">
                                        <div class="product-price">
                                            @if (isset($product->salePrice))
                                                <small>{{ $product->salePrice }}</small>
                                            @endif
                                            {{ $product->price }} Р
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{ $products->onEachSide(3)->links() }}
    </div>
    <script src="{{ asset('public/js/script.js') }}"></script>
@endsection
