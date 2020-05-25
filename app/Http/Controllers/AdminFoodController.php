<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use App\Model\Food;
use App\Model\Restaurant;
use Illuminate\Http\Request;

class AdminFoodController extends Controller
{
    public function addRestaurant(Request $request)
    {
        allowed(Role::FOOD_MANAGER);

        return view('admin_food.restaurant');
    }

    public function addRestaurantSubmit(Request $request)
    {
        allowed(Role::FOOD_MANAGER);

        $request->validate([
            'name' => 'required|string|unique:restaurants,name'
        ]);

        $restaurant       = new Restaurant();
        $restaurant->name = $request->get('name');
        $restaurant->save();

        return redirect()->back()->with('msg-ok', __('msg.add_ok', ['name' => $request->get('name')]));
    }

    public function restaurantsList()
    {
        allowed(Role::FOOD_MANAGER);

        return view('admin_food.restaurants_list', ['restaurants' => Restaurant::all()]);
    }

    public function addFood(Request $request)
    {
        allowed(Role::FOOD_MANAGER);

        $data['restaurants'] = Restaurant::all();

        return view('admin_food.food', $data);
    }

    public function addFoodSubmit(Request $request)
    {
        allowed(Role::FOOD_MANAGER);

        $request->validate([
            'name' => 'required|string',
            'restaurant' => 'required|exists:restaurants,id',
            'price' => 'required|numeric'
        ]);

        $food                = new Food();
        $food->name          = $request->get('name');
        $food->restaurant_id = $request->get('restaurant');
        $food->price         = to_en($request->get('price')); //todo convert number
        $food->save();

        return redirect()->back()->with('msg-ok', __('msg.add_ok', ['name' => $request->get('name')]));
    }

    public function foodsList()
    {
        allowed(Role::FOOD_MANAGER);

        $data['foods'] = Food::query()
            ->orderBy('restaurant_id')
            ->with('Restaurant')
            ->get();

        return view('admin_food.foods_list', $data);
    }
}
