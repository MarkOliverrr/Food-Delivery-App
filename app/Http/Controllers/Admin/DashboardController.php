<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Dish;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $stats = [
            'restaurants' => Restaurant::count(),
            'dishes' => Dish::count(),
            'users' => User::count(),
            'totalOrders' => Order::count(),
            'categories' => Category::count(),
            'processingOrders' => Order::where('status', 'in process')->count(),
            'deliveredOrders' => Order::where('status', 'closed')->count(),
            'cancelledOrders' => Order::where('status', 'rejected')->count(),
            'totalEarnings' => Order::where('status', 'closed')->sum('price'),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}

