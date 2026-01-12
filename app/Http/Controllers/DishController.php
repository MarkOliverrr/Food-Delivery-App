<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        $restaurant->load('category');
        $dishes = Dish::where('rs_id', $restaurant->rs_id)->get();
        return view('dishes.index', compact('restaurant', 'dishes'));
    }

    public function show($restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        $restaurant->load('category');
        $dishes = Dish::where('rs_id', $restaurant->rs_id)->get();
        return view('dishes.index', compact('restaurant', 'dishes'));
    }
}

