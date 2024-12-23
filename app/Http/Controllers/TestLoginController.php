<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Testlogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\RedirectResponse;

class TestLoginController extends Controller
{
    public function index()
    {
        return view('login2');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function register(request $request)
    {
        // Validate the request (done by RegisterRequest)
        $validatedData = $request->validated();

        // Create the user
        $user = Testlogin::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Optionally log the user in after registration
        Auth::login($user);

        // Redirect with success message
        return redirect()->route('home')->with('success', 'Your account has been created!');
}
}