<?php

namespace App\Http\Controllers\Admin;

use App\Model\Food;
use App\Model\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{
    public function addRestaurant(Request $request)
    {
        allowed('food_management');

        return view('admin.tahdig.food.restaurant_add');
    }

    public function addRestaurantSubmit(Request $request)
    {
        allowed('food_management');

        $request->validate([
            'name' => 'required|string|unique:restaurants,name',
        ]);

        $restaurant = new Restaurant();
        $restaurant->name = $request->get('name');
        $restaurant->save();

        return redirect()->back()->with('msg-ok', __('msg.add_ok', ['name' => $request->get('name')]));
    }

    public function restaurantsList()
    {
        allowed('food_view');

        return view('admin.tahdig.food.restaurant_list', ['restaurants' => Restaurant::all()]);
    }

    public function addFood(Request $request)
    {
        allowed('food_management');

        $data['restaurants'] = Restaurant::all();

        return view('admin.tahdig.food.food_add', $data);
    }

    public function editFood(Request $request, $foodId)
    {
        allowed('food_management');

        $data['food'] = Food::findOrFail($foodId);

        return view('admin.tahdig.food.food_edit', $data);
    }

    public function addFoodSubmit(Request $request)
    {
        allowed('food_management');

        $request->validate([
            'name' => 'required|string',
            'restaurant' => 'required|exists:restaurants,id',
            'price' => 'required|numeric',
        ]);

        $food = new Food();
        $food->name = $request->get('name');
        $food->restaurant_id = $request->get('restaurant');
        $food->price = to_en($request->get('price')); //todo convert number
        $food->save();

        return redirect()->back()->with('msg-ok', __('msg.add_ok', ['name' => $request->get('name')]));
    }

    public function editFoodSubmit(Request $request)
    {
        allowed('food_management');

        $request->validate([
            'id' => 'required|exists:foods,id',
            'price' => 'required|numeric',
        ]);

        $food = Food::find($request->get('id'));
        $food->price = to_en($request->get('price')); //todo convert number
        $food->save();

        return redirect()->back()->with('msg-ok', __('msg.add_ok', ['name' => $request->get('name')]));
    }

    public function foodsList()
    {
        allowed('food_view');

        $data['foods'] = Food::query()
            ->orderBy('restaurant_id', 'asc')
            ->orderBy('name', 'asc')
            ->with('Restaurant')
            ->get();

        return view('admin.tahdig.food.food_list', $data);
    }
}
