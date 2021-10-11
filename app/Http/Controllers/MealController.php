<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Meal;
use App\Models\User;


class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::orderBy('created_at', 'desc')->paginate(9);
        return view('welcome', compact('meals'));
    }

    public function create()
    {
        return view('createMeal');
    }

    public function store(Request $request)
    {
        $city = $request->city;
        $apiKey = 'e16e6f397ecd165a6d4c823042160975';
        $res = Http::get("api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$apiKey}");

        $temp = $res->json()['main']['temp'];




        $meal = Meal::create([
            'image' => basename($request->image->store('images', 'public')),
            'description' => $request->description,
            'user_id' => $request->user_id,
            'meteo' => $temp,
        ]);
    }
}
