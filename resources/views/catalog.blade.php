@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="mb-3">
                    <div class="categories-body">
                        {{-- <ul class="list-group list-group-flush">
                            @foreach ($categories as $category)
                                <li class="catalog-link"><a href="/catalog/{{ $category->id }}">{{ $category->name }}</a></li>
                                <div class="divider-line"></div>
                            @endforeach
                        </ul> --}}
                        <ul class="list-group list-group-flush">
                            @foreach ($rootCategories as $rootCategory)
                                <li class="catalog-link"><a
                                        href="/catalog/{{ $rootCategory->id }}">{{ $rootCategory->name }}</a></li>
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
                <div class="mb-3">
                    <div class="card-body">
                        <!-- здесь будет форма с фильтрами -->
                    </div>
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
                                    <a class="product-category"
                                        href="/catalog/{{ $product->Category->id }}">{{ $product->Category->name }}</a>
                                    <a class="card-link" href="/catalog/{{ $product->Category->id }}/{{ $product->id }}">
                                        <h4>{{ $product->name }}</h4>
                                    </a>
                                    <div class="product-bottom-details">
                                        <div class="product-price">

                                            @if (isset($product->salePrice))
                                                <small>$product->salePrice</small>
                                            @endif
                                            {{ $product->price }} Р
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{ $products->onEachSide(3)->links() }}
    </div>
@endsection
