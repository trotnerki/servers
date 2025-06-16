@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Оформление заказа</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="address">Адрес доставки</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>

                    <h5 class="mt-4">Товары в заказе:</h5>
                    <ul class="list-group mb-4">
                        @foreach($cart as $id => $item)
                            <li class="list-group-item">
                                {{ $item['name'] }} - {{ $item['quantity'] }} × {{ number_format($item['price'], 2) }} ₽
                            </li>
                        @endforeach
                        <li class="list-group-item list-group-item-info">
                            <strong>Итого: {{ number_format($total, 2) }} ₽</strong>
                        </li>
                    </ul>

                    <button type="submit" class="btn btn-primary btn-lg">Подтвердить заказ</button>
                </form>
            </div>
        </div>
    </div>
@endsection
