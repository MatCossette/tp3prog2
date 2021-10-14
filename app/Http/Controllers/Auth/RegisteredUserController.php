<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Meal;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Symfony\Component\HttpKernel\Profiler\Profile;

class RegisteredUserController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        $offeredMeals = $user->meals;
        $reserved = $user->food_id;
        $reservedMeal = Meal::find(['id', '=', $reserved]);
        return view('auth.profile', compact('offeredMeals', 'reservedMeal'));
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'food_id' => null,
            'city' => $request->city,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/')->with('status', 'Votre compte a été créé. Vous êtes connecté.');
    }

    public function edit()
    {
        return view('auth.edit-profile');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
        ]);

        $user = User::find($id);
        $oldEmail = $user->email;        
        if($oldEmail === $request->input('email')) {
            $user->email = $user->email;
        } else {
            $user->email = $request->input('email');
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]);
        }

        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->city = $request->city;
        if(empty($request->input('password'))){
            $user->password = $user->password;
        } else {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()]
            ]);
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect('/')->with('status', 'Votre compte a été mis à jour.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($user->food_id != null){
            Meal::destroy(['id', '=', $user->food_id]);
        }
        User::destroy($id);
        return redirect('/')->with('status', 'Votre compte a été supprimé.');
    }

}
