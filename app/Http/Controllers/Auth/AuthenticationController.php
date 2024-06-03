<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthenticationController extends Controller
{
    public function showAuthenticationForm()
    {
        return view('welcome');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful
            return redirect()->intended('/dashboard'); // Redirect to dashboard or any other page
        } else {
            // Authentication failed
            return back()->withErrors(['username' => 'Invalid user ID or password'])->withInput($request->only('username'));
        }
    }
}
