@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Категории
                </div>
                <div class="list-group list-group-flush">
                    @foreach($categories as $category)
                        <a href="{{ route('categories.show', $category) }}"
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            {{ $category->name }}
                            <span class="badge bg-primary rounded-pill">{{ $category->products_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <h1 class="mb-4">Каталог товаров</h1>

            @if($products->count())
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($products as $product)
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
                                        <form action="{{ route('cart.add', $product) }}" method="POST" class="ms-2">
                                            @csrf
                                            <div class="input-group input-group-sm" style="width: 130px;">
                                                <input type="number" name="quantity" value="1" min="1" class="form-control">
                                                <button type="submit" class="btn btn-sm btn-success">В корзину</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    Товары не найдены. Вернитесь позже.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
