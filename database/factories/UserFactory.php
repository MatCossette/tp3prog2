<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

    protected $model = User::class;

    private static $order = 1;

    
    public function definition()
    {
        return [
            'name' => $this->faker->firstname(),
            'email' => 'user' . self::$order . '@user' . self::$order++ . '.ca',
            'email_verified_at' => now(),
            'address' => $this->faker->streetAddress(),
            'city' => 'Quebec',
            'food_id' => null,
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
