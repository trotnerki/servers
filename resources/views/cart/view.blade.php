@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Ваша корзина</h1>

    @if(session('cart') && count(session('cart')))
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Сумма</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <tr>
                            <td>{{ $details['name'] }}</td>
                            <td>{{ number_format($details['price'], 2) }} ₽</td>
                            <td>{{ $details['quantity'] }}</td>
                            <td>{{ number_format($details['price'] * $details['quantity'], 2) }} ₽</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">×</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Итого:</th>
                        <th colspan="2">{{ number_format($total, 2) }} ₽</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Очистить корзину</button>
            </form>
            <a href="#" class="btn btn-primary">Оформить заказ</a>
        </div>
    @else
        <div class="alert alert-info">
            Ваша корзина пуста
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Вернуться к покупкам</a>
    @endif
</div>
@endsection
