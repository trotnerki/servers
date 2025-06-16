@extends('layouts.app')

@section('content')
<div class="container py-4">
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
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ $product->category->name ?? 'Без категории' }}</p>
                            <p class="card-text">{{ number_format($product->price, 2) }} ₽</p>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">Подробнее</a>
                            <a href="{{ route('cart.add', $product) }}" class="btn btn-sm btn-success">В корзину</a>
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
@endsection
