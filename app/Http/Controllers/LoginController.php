<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credential = $request->validate([
            'username' => 'required',
            'password' => 'required|min:5|max:255'
        ]);

        if (Auth::attempt($credential)) {
           $request->session()->regenerate();
           return redirect()->intended('/')->with('success', 'Selamat Datang '.$request->input("username"));
        }

        return back()->with('error', 'Invalid Username Or Password');
    }

    public function store(Request $request)
    {
        //cek apakah password & confirm_password itu sama
        $request->validate([
            'password' => 'required|min:5|max:255',
            'confirm_password' => 'required|same:password'
        ]);

        $validateData = $request->validate([
            'username' => 'required|min:5|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        User::create($validateData);
        return redirect('/')->with('success', 'Register Succsessfuly');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
