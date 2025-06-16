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
            <div class="card">
                <div class="card-body">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}"
                             class="img-fluid rounded mb-4"
                             alt="{{ $product->name }}"
                             style="max-height: 400px; width: 100%; object-fit: cover;">
                    @endif

                    <h1 class="mb-3">{{ $product->name }}</h1>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="h4 text-primary">{{ number_format($product->price, 2) }} ₽</span>
                        <span class="badge bg-secondary">{{ $product->category->name ?? 'Без категории' }}</span>
                    </div>

                    @if($product->description)
                        <div class="mb-4">
                            <h5>Описание товара:</h5>
                            <p class="lead">{{ $product->description }}</p>
                        </div>
                    @endif

                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-4">
                        @csrf
                        <div class="input-group" style="max-width: 250px;">
                            <input type="number" name="quantity" value="1" min="1" class="form-control">
                            <button type="submit" class="btn btn-primary">Добавить в корзину</button>
                        </div>
                    </form>

                    @if($relatedProducts->count())
                        <hr>
                        <h4 class="mb-3">Похожие товары</h4>
                        <div class="row row-cols-1 row-cols-md-4 g-4">
                            @foreach($relatedProducts as $related)
                                <div class="col">
                                    <div class="card h-100">
                                        @if($related->image)
                                            <img src="{{ asset('storage/'.$related->image) }}"
                                                 class="card-img-top"
                                                 alt="{{ $related->name }}"
                                                 style="height: 120px; object-fit: cover;">
                                        @endif
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $related->name }}</h6>
                                            <p class="card-text text-primary fw-bold">{{ number_format($related->price, 2) }} ₽</p>
                                        </div>
                                        <div class="card-footer bg-white">
                                            <a href="{{ route('products.show', $related) }}" class="btn btn-sm btn-outline-primary">Подробнее</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                            ← Назад
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
