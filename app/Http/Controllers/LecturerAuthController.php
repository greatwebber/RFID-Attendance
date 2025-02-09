<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lecturer;
use Illuminate\Support\Facades\Hash;

class LecturerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('lecturer.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('lecturer')->attempt($request->only('email', 'password'))) {
            return redirect()->route('lecturer.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid Credentials']);
    }

    public function logout()
    {
        Auth::guard('lecturer')->logout();
        return redirect()->route('lecturer.login');
    }
}
