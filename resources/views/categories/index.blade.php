@extends('layouts.app')

@section('content')
<div class="container py-4">
    @unless(isset($singleCategoryView))
        <h1 class="mb-4">Каталог категорий</h1>
    @endunless

    @foreach($categories as $category)
        <div class="card mb-4">
            @unless(isset($singleCategoryView))
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">{{ $category->name }}</h2>
                        <span class="badge bg-primary">{{ $category->products_count }} товаров</span>
                    </div>
                </div>
            @endunless

            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($category->products as $product)
                        <div class="col">
                            <div class="card h-100">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}"
                                         class="card-img-top"
                                         alt="{{ $product->name }}"
                                         style="height: 180px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text text-primary fw-bold">{{ number_format($product->price, 2) }} ₽</p>
                                </div>
                                <div class="card-footer bg-white">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('products.show', $product) }}"
                                           class="btn btn-sm btn-outline-primary">Подробнее</a>
                                        <form action="{{ route('cart.add', $product) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">В корзину</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
