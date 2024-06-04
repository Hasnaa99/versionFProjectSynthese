<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function show()
    {
        return view('login.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('matricule', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('acceuil');
        }
        return redirect()->back()->withErrors(['error' => 'Login ou mot de passe incorrecte.']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
}
