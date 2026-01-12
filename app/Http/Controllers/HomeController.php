<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $popularDishes = Dish::limit(6)->get();
        $restaurants = Restaurant::with('category')->get();
        $categories = Category::all();

        return view('home', compact('popularDishes', 'restaurants', 'categories'));
    }
}

