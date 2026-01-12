<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $restaurants = Restaurant::with('category')->get();
        return view('admin.restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.restaurants.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'c_id' => 'required|exists:res_categories,c_id',
            'title' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'url' => 'nullable|url',
            'o_hr' => 'required|string',
            'c_hr' => 'required|string',
            'o_days' => 'required|string',
            'address' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurants', 'public');
            $validated['image'] = basename($imagePath);
        }

        Restaurant::create($validated);

        return redirect()->route('admin.restaurants.index')->with('success', 'Restaurant added successfully!');
    }

    public function edit(Restaurant $restaurant)
    {
        $categories = Category::all();
        return view('admin.restaurants.edit', compact('restaurant', 'categories'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'c_id' => 'required|exists:res_categories,c_id',
            'title' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'url' => 'nullable|url',
            'o_hr' => 'required|string',
            'c_hr' => 'required|string',
            'o_days' => 'required|string',
            'address' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($restaurant->image) {
                Storage::disk('public')->delete('restaurants/' . $restaurant->image);
            }
            $imagePath = $request->file('image')->store('restaurants', 'public');
            $validated['image'] = basename($imagePath);
        }

        $restaurant->update($validated);

        return redirect()->route('admin.restaurants.index')->with('success', 'Restaurant updated successfully!');
    }

    public function destroy(Restaurant $restaurant)
    {
        if ($restaurant->image) {
            Storage::disk('public')->delete('restaurants/' . $restaurant->image);
        }
        $restaurant->delete();

        return redirect()->route('admin.restaurants.index')->with('success', 'Restaurant deleted successfully!');
    }
}

