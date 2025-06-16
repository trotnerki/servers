<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        try {

            $quantity = $request->input('quantity', 1);


            $validated = $request->validate([
                'quantity' => 'sometimes|integer|min:1|max:10'
            ], [
                'quantity.min' => 'Количество должно быть не менее 1',
                'quantity.max' => 'Максимальное количество - 10'
            ]);


            $cart = session()->get('cart', []);


            if (isset($cart[$product->id])) {
                $newQuantity = $cart[$product->id]['quantity'] + $quantity;
                if ($newQuantity > 10) {
                    return redirect()->back()->with('error', 'Нельзя добавить больше 10 единиц одного товара');
                }
                $cart[$product->id]['quantity'] = $newQuantity;
            } else {
                $cart[$product->id] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "quantity" => $quantity,
                    "price" => $product->price,
                    "image" => $product->image ? asset('storage/'.$product->image) : null,
                    "stock" => $product->stock
                ];
            }


            session()->put('cart', $cart);


            Log::info('Товар добавлен в корзину', [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'cart' => $cart
            ]);

            return redirect()->back()->with('success', 'Товар успешно добавлен в корзину');

        } catch (\Exception $e) {
            Log::error('Ошибка при добавлении в корзину: '.$e->getMessage());
            return redirect()->back()->with('error', 'Произошла ошибка при добавлении товара в корзину');
        }
    }

    public function remove(Product $product)
    {
        try {
            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {
                unset($cart[$product->id]);
                session()->put('cart', $cart);

                Log::info('Товар удален из корзины', [
                    'product_id' => $product->id
                ]);

                return redirect()->back()->with('success', 'Товар удален из корзины');
            }

            return redirect()->back()->with('error', 'Товар не найден в корзине');

        } catch (\Exception $e) {
            Log::error('Ошибка при удалении из корзины: '.$e->getMessage());
            return redirect()->back()->with('error', 'Произошла ошибка при удалении товара');
        }
    }

    public function clear()
    {
        try {
            session()->forget('cart');
            Log::info('Корзина очищена');
            return redirect()->route('cart.view')->with('success', 'Корзина очищена');
        } catch (\Exception $e) {
            Log::error('Ошибка при очистке корзины: '.$e->getMessage());
            return redirect()->back()->with('error', 'Произошла ошибка при очистке корзины');
        }
    }

    public function view()
    {
        try {
            $cart = session()->get('cart', []);
            $total = 0;

            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            return view('cart.view', [
                'cart' => $cart,
                'total' => $total,
                'cartCount' => count($cart)
            ]);

        } catch (\Exception $e) {
            Log::error('Ошибка при просмотре корзины: '.$e->getMessage());
            return redirect()->route('home')->with('error', 'Произошла ошибка при загрузке корзины');
        }
    }
}
