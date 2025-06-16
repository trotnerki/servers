@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Ваша корзина</h1>

        @if (empty($cart))
            <div class="alert alert-info">Ваша корзина пуста</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Товар</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Сумма</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $id => $item)
                            <tr>
                                <td>
                                    @if($item['image'])
                                        <img src="{{ asset('storage/' . $item['image']) }}" width="50" class="mr-2">
                                    @endif
                                    {{ $item['name'] }}
                                </td>
                                <td>{{ number_format($item['price'], 2) }} ₽</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ number_format($item['price'] * $item['quantity'], 2) }} ₽</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('cart.add', $id) }}" class="btn btn-primary">+</a>
                                        <a href="{{ route('cart.remove', $id) }}" class="btn btn-warning">-</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Итого:</strong></td>
                            <td><strong>{{ number_format($total, 2) }} ₽</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('cart.clear') }}" class="btn btn-danger">Очистить корзину</a>
                <a href="{{ route('cart.checkout') }}" class="btn btn-success">Оформить заказ</a>
            </div>
        @endif
    </div>
@endsection
