<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('administrator.login.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['email' => 'required|email', 'password' => 'required|min:6']);
        $loginAttemptResult = Auth::guard('admin')->attempt($validated);

        if (!$loginAttemptResult) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        return to_route('admin.dashboard.index');
    }
}
