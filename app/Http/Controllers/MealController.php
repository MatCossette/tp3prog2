<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image as InterventionImage;



class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::where('is_reserved', '=', '0')->latest()->paginate(9);
        $usersOffering = User::all('id', 'name', 'address', 'city');
        $message = '';
        if($meals->isEmpty()){
            $message = "Désolé, il n'y a plus de repas sur cette page.";
        }
        return view('welcome', compact('meals', 'usersOffering', 'message'));
        

    }

    public function create()
    {
        return view('createMeal');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => ['required', 'string', 'max:255']
        ]);


        if(empty($request->image)){
            $imagePath = "placeholdermeal.svg";
        }else{
            $imagePath = basename($request->image->store('images', 'public'));
            $image = InterventionImage::make($request->image)->widen(500)
            ->encode();
        Storage::put('public/thumbs/' . $imagePath, $image);
        }

        $city = $request->city;
        $apiKey = 'e16e6f397ecd165a6d4c823042160975';
        $res = Http::get("api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$apiKey}");

        $temp = $res->json()['main']['temp'];
        if(empty($request->time)){
            $time = now();
        }else{
            $time = $request->time;
        }



        $meal = Meal::create([
            'image' => $imagePath,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'meteo' => $temp,
            'created_at' => $time,
        ]);

        event(new $meal);

        return redirect('/')->with('status', "Le repas a été enregistré.");
    }

    public function reserve($foodCard, $id)
    {
        $customer = User::find($id);
        if($customer->food_id == null){
            $customer->food_id = $foodCard;
            $customer->save();
            $reservedMeal = Meal::find($foodCard);
            $reservedMeal->is_reserved = true;
            $reservedMeal->save();
            return Redirect::back()->with('status', "Votre repas est réservé!");
        } else {
            return Redirect::back()->with('warning', "Vous devez ramasser votre repas réservé avant de pouvoir en réserver un autre.");
        }
    }

    public function destroy($id)
    {
        Meal::destroy($id);
        return Redirect::back()->with('status', 'Le repas a été effacé.');
    }

    public function erase($id)
    {
        Meal::destroy($id);
        return Redirect::back()->with('status', 'Repas récupéré! Vous pouvez réserver un autre repas.');
    }
}
