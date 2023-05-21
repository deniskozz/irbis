@extends('layouts.app')

@section('content')
    <link href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" rel="stylesheet" type="text/css" />
    <div class="container">
        <div class="breadcrumb mb-4">
            <a class="product-page_link" href="{{ route('catalog') }}">Каталог</a>
            <span>/</span>
            <a class="product-page_link" href="/catalog/{{ $currentProduct->category->id }} ">
                {{ $currentProduct->category->name }}
            </a>
            <span>/</span>
            <span>{{ $currentProduct->name }}</span>
        </div>
        <div class="row">
            <div class="col-md-6 col-12">
                <img alt="" class="img-fluid" src="{{ Storage::url($currentProduct->img) }}">
            </div>
            <div class="col-md-6 col-12">
                <h1>{{ $currentProduct->name }}</h1>
                <div class="row">
                    <div class="price">
                        <span>{{ $currentProduct->price }} ₽</span>
                    </div>
                    <form action="/cart/add" class="to_cart-form" method="post">
                        <div class="quantity-counter">
                            <button class="minus-btn amount-btn" onclick="event.preventDefault()">-</button>
                            <input class="amount-input" id="quantity-input" max="{{ $currentProduct->amount }}"
                                min="1" name="quantity" type="text" value="1">
                            <button class="plus-btn amount-btn" onclick="event.preventDefault()">+</button>
                        </div>
                        <input name="product_id" type="hidden" value="{{ $currentProduct->id }}">
                        @csrf
                        <input class="to_cart-btn" type="submit" value="В корзину">
                    </form>

                </div>
            </div>
        </div>
        <div class="row divider-row">
            <ul class="nav nav-tabs mt-5 mb-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <a aria-controls="simple-tabpanel-0" aria-selected="true" class="nav-link active tab-name"
                        data-bs-toggle="tab" href="#simple-tabpanel-0" id="simple-tab-0" role="tab"> ОПИСАНИЕ </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a aria-controls="simple-tabpanel-1" aria-selected="false" class="nav-link tab-name"
                        data-bs-toggle="tab" href="#simple-tabpanel-1" id="simple-tab-1" role="tab"> ХАРАКТЕРИСТИКИ
                    </a>
                </li>
            </ul>
            <div class="tab-content mb-5" id="tab-content">
                <div aria-labelledby="simple-tab-0" class="tab-pane active" id="simple-tabpanel-0" role="tabpanel">
                    <p>{{ $currentProduct->description }}</p>
                </div>
                <div aria-labelledby="simple-tab-1" class="tab-pane" id="simple-tabpanel-1" role="tabpanel">
                    <pre>{{ $currentProduct->parameters }}</pre>
                </div>
            </div>
        </div>
        <div class="slider">
            @foreach ($relatedProducts as $product)
                <div class="slider-item col-md-4 mb-3">
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
                </div>
            @endforeach
        </div>
    </div>




    <script>
        var currentProduct = <?php echo json_encode($currentProduct->amount); ?>;
    </script>
    <!-- Include the required CSS and JS files -->
    <link href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


    <script src="{{ asset('public/js/slider.js') }}"></script>
    <script src="{{ asset('public/js/script.js') }}"></script>
@endsection
