<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'remark');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:in process,closed,rejected',
            'remark' => 'nullable|string',
        ]);

        $order->update(['status' => $validated['status']]);

        if (!empty($validated['remark'])) {
            $order->remark()->updateOrCreate(
                ['frm_id' => $order->o_id],
                [
                    'status' => $validated['status'],
                    'remark' => $validated['remark'],
                ]
            );
        }

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully!');
    }
}

