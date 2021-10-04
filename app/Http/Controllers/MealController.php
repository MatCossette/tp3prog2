<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\User;

class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::orderBy('created_at', 'desc')->paginate(9);
        return view('welcome', compact('meals'));
    }
}
