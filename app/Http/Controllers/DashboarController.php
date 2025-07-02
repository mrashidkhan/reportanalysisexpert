<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalReport;

class DashboardController extends Controller
{
    /**
     * Redirect users to appropriate dashboard based on role
     */
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('patient.dashboard');
    }

    /**
     * Show admin dashboard
     */
    public function adminDashboard()
    {
        $reports = MedicalReport::with('user')->get();
        return view('admin.dashboard', compact('reports'));
    }

    /**
     * Show patient dashboard
     */
    public function patientDashboard()
    {
        $reports = auth()->user()->medicalReports;
        return view('patient.dashboard', compact('reports'));
    }
}
