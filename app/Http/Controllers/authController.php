<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login_auth(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            if (Auth::user()->roles->role == 'user') {
                return redirect()->intended('/');
            } else if (Auth::user()->roles->role == 'admin') {
                return redirect()->intended('/admin');
            } else if (Auth::user()->roles->role == 'artist') {
                return redirect()->intended('/artist');
            } else {
                return redirect()->intended('/'); 
            }
        }

        return back()->with(['error' => 'Password atau email tidak sesuai']);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
