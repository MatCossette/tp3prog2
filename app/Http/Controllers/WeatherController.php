<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class WeatherController extends Controller
{
    //
    public function getMeteo()
    {
        $city = 'Quebec';
        $apiKey = 'e16e6f397ecd165a6d4c823042160975';
        $res = Http::get("api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$apiKey}");

        $temp = $res->json()['main']['temp'];
    }
}
