<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class WeatherController extends Controller
{
    //
    public function getWeather()
    {
        $weatherNow = Http::get('api.openweathermap.org/data/2.5/weather?q=Montreal&country code=124&units=metric&lang=fr&appid=e16e6f397ecd165a6d4c823042160975');
        //return json_decode($weatherNow);

        return view("weatherNow", [
            "weatherNow" => json_decode($weatherNow)
        ]);
    }
}
