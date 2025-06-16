@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="jumbotron bg-light p-5 rounded">
        <h1 class="display-4">Добро пожаловать в наш магазин цветов!</h1>
        <p class="lead">Свежие букеты и композиции для любого события</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Каталог товаров</a>
    </div>

    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Свежие цветы</h5>
                    <p class="card-text">Ежедневные поставки свежих цветов от проверенных поставщиков</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Быстрая доставка</h5>
                    <p class="card-text">Доставка по городу в течение 2 часов</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Профессиональные флористы</h5>
                    <p class="card-text">Индивидуальный подход к каждому заказу</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
