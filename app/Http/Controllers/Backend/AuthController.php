<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $title = "Login";

        return view('backend.auth.login', compact('title'));
    }

    public function authentication(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember_token = $request->remember_token;

        if (Auth::attempt($credentials, $remember_token)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.index')
                ->with('success', 'You Have Signed in Successfully!');
        }

        return back()->with('error', 'You failed to Login!')->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->with('success', 'Logout Successful!');;
    }
}
