<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('restaurants.index')->with('error', 'Your cart is empty!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('restaurants.index')->with('error', 'Your cart is empty!');
        }

        foreach ($cart as $item) {
            Order::create([
                'u_id' => Auth::id(),
                'title' => $item['title'],
                'quantity' => $item['quantity'],
                'price' => $item['price'] * $item['quantity'],
                'status' => null,
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.my')->with('success', 'Order placed successfully!');
    }

    public function myOrders()
    {
        $orders = Order::where('u_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.my-orders', compact('orders'));
    }

    public function destroy(Order $order)
    {
        if ($order->u_id !== Auth::id()) {
            abort(403);
        }

        $order->delete();

        return redirect()->route('orders.my')->with('success', 'Order cancelled successfully!');
    }
}

