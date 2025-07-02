<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MedicalReportController;
use App\Models\MedicalReport;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
    $request->session()->regenerate();

    if (auth()->user()->isAdmin()) {
        // Fetch all medical reports in descending order
        $reports = MedicalReport::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('reports'));
    }

    // Fetch medical reports that belong to the authenticated patient
    $reports = MedicalReport::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
    return view('patient.dashboard', compact('reports'));
}


        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
