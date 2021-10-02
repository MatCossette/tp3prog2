<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function Psy\debug;

class WeatherController extends Controller
{
    public function getWeather($city)
    {
        $weatherNow = Http::get('api.openweathermap.org/data/2.5/weather?q=Quebec&country code=124&units=metric&lang=fr&appid=e16e6f397ecd165a6d4c823042160975');
        $weatherTemp = json_decode($weatherNow);
        dd($weatherTemp->main->temp);


        return view('weatherNow', compact('city'));
    }
}
