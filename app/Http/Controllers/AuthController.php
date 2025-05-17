<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.index');
    }

    public function login(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        if($user){

            $password = $request->input('password');

            $credentials = [ 
                'email' => $email,
                'password' => $password,
            ];

            if (Auth::attempt($credentials)) {

                $request->session()->regenerate();
                
                return redirect()->route('admin-dashboard');
            }

            return back()->withErrors([
                'error' => 'Incorrect email or password!',
            ])->withInput();

        }else{

            return back()->withErrors([
                'error' => 'User not found!',
            ])->withInput();

        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth-admin-index');
    }
}
