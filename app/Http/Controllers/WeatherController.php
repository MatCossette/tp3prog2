<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function Psy\debug;

class WeatherController extends Controller
{
    //
    public function getWeather()
    {
        $weatherNow = Http::get('api.openweathermap.org/data/2.5/weather?q=Montreal&country code=124&units=metric&lang=fr&appid=e16e6f397ecd165a6d4c823042160975');
        $weatherCity = json_decode($weatherNow);
        dd($weatherCity->main->temp);


        // return view("weatherNow", [
        //     "weatherNow" => json_decode($weatherNow)
        // ]);
    }
}
