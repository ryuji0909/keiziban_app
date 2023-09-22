<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
      */
    public function create(): View
    {
        
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string'],
            'phonetic' => ['required', 'string'], 
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ],User::$messages, User::$validationAttributes);
        
    

        $user = User::create([
            'username' => $request->username,
            'phonetic' =>$request->phonetic,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'user_type_id' => 0 //本当は定数で書く。
        ]);

        event(new Registered($user));

        // Auth::login($user); //新規登録直後に自動でログインされる

        return redirect('/login');
    }
}
