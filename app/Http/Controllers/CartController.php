<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Товар добавлен в корзину');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart');

        if (isset($cart[$product->id])) {
            if ($cart[$product->id]['quantity'] > 1) {
                $cart[$product->id]['quantity']--;
            } else {
                unset($cart[$product->id]);
            }

            session()->put('cart', $cart);
        }

        return back()->with('success', 'Товар удален из корзины');
    }

    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Корзина очищена');
    }

    public function view()
    {
        $cart = session()->get('cart', []);
        $total = array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);

        return view('cart.view', compact('cart', 'total'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Корзина пуста');
        }

        return view('cart.checkout');
    }
}
