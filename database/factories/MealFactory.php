<?php

namespace Database\Factories;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Database\Factories\UserFactory;

class MealFactory extends Factory
{
    protected $model = Meal::class;

    public function definition()
    {
        $city = 'montreal';
        $apiKey = 'e16e6f397ecd165a6d4c823042160975';
        $res = Http::get("api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$apiKey}");

        $temp = $res->json()['main']['temp'];

        return [
            'description' => $this->faker->realText($maxNbChars = 50),
            'image' => 'placeholdermeal.svg',
            'meteo' => $temp,
            'user_id' => $this->faker->numberBetween($min = 1, $max = 5),
            'is_reserved' => '0',
        ];
    }
}
