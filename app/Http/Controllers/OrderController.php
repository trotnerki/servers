<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.product'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        // Логика создания заказа обычно через корзину
        return redirect()->route('cart.view');
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart');

        if (empty($cart)) {
            return back()->with('error', 'Корзина пуста');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0),
            'status' => 'pending',
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price']
            ]);
        }

        session()->forget('cart');
        return redirect()->route('orders.show', $order)->with('success', 'Заказ оформлен');
    }

    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.product']);
        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Статус обновлен');
    }

}
