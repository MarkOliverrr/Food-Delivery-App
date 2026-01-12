<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $dishes = Dish::with('restaurant')->get();
        return view('admin.dishes.index', compact('dishes'));
    }

    public function create()
    {
        $restaurants = Restaurant::all();
        return view('admin.dishes.create', compact('restaurants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rs_id' => 'required|exists:restaurants,rs_id',
            'title' => 'required|string|max:255',
            'slogan' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'img' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('dishes', 'public');
            $validated['img'] = basename($imagePath);
        }

        Dish::create($validated);

        return redirect()->route('admin.dishes.index')->with('success', 'Dish added successfully!');
    }

    public function edit(Dish $dish)
    {
        $restaurants = Restaurant::all();
        return view('admin.dishes.edit', compact('dish', 'restaurants'));
    }

    public function update(Request $request, Dish $dish)
    {
        $validated = $request->validate([
            'rs_id' => 'required|exists:restaurants,rs_id',
            'title' => 'required|string|max:255',
            'slogan' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'img' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('img')) {
            if ($dish->img) {
                Storage::disk('public')->delete('dishes/' . $dish->img);
            }
            $imagePath = $request->file('img')->store('dishes', 'public');
            $validated['img'] = basename($imagePath);
        }

        $dish->update($validated);

        return redirect()->route('admin.dishes.index')->with('success', 'Dish updated successfully!');
    }

    public function destroy(Dish $dish)
    {
        if ($dish->img) {
            Storage::disk('public')->delete('dishes/' . $dish->img);
        }
        $dish->delete();

        return redirect()->route('admin.dishes.index')->with('success', 'Dish deleted successfully!');
    }
}

