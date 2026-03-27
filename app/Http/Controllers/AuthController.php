<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{

    // When a user signs up, validates and inserts in DB
    public function signup(Request $req) {
        $req->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        $user = User::create([
            'user' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        Auth::login($user);
        return redirect('/');
    }

    // Authenticates a user's login
    public function login(Request $req) {
        $credentials = $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Validates creds against actual user and password
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'error' => 'Invalid credentials'
            ]);
        }

        $req->session()->regenerate();
        return redirect('/');
    }

    // Logs user out
    public function logout(Request $req) {
        Auth::logout();

        // Clears sessions
        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect('/login');
    }
}
