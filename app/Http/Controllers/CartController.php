<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'dish_id' => 'required|exists:dishes,d_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $dish = Dish::findOrFail($request->dish_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$dish->d_id])) {
            $cart[$dish->d_id]['quantity'] += $request->quantity;
        } else {
            $cart[$dish->d_id] = [
                'd_id' => $dish->d_id,
                'title' => $dish->title,
                'quantity' => $request->quantity,
                'price' => $dish->price,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function remove($dishId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$dishId])) {
            unset($cart[$dishId]);
            session()->put('cart', $cart);
        }

        $restaurantId = request()->query('res_id');
        if ($restaurantId) {
            return redirect()->route('dishes.show', $restaurantId)->with('success', 'Item removed from cart!');
        }

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    public function empty()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart emptied!');
    }
}

