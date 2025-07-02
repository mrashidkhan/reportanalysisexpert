<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MedicalReportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LegalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/contactus', [PageController::class, 'contactus'])->name('contactus');
Route::get('/aboutus', [PageController::class, 'aboutus'])->name('aboutus');
Route::get('/departments', [PageController::class, 'departments'])->name('departments');
Route::get('/doctors', [PageController::class, 'doctors'])->name('doctors');
Route::get('/reportsupload', [PageController::class, 'reportsupload'])->name('reports.upload');

// ========================================
// MEDICAL REPORTS ROUTES
// ========================================

// Public Routes - Medical Report Upload & Management
Route::prefix('medical-reports')->name('medical-reports.')->group(function () {

    // Upload Form & Processing
    Route::get('/upload', [MedicalReportController::class, 'index'])->name('upload');
    Route::post('/upload', [MedicalReportController::class, 'upload'])->name('uploadreports');

    // Success & Report View
    Route::get('/success/{id}', [MedicalReportController::class, 'success'])->name('success');
    Route::get('/report/{id}', [MedicalReportController::class, 'show'])->name('show');

    // File Download
    Route::get('/download/{reportId}/{fileIndex}', [MedicalReportController::class, 'downloadFile'])
        ->name('download');

    // PDF Download (if implemented)
    Route::get('/download-pdf/{id}', [MedicalReportController::class, 'downloadPdf'])
        ->name('download-pdf');
});

// Admin Routes - Protected by Authentication & Authorization
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Medical Reports Management
    Route::prefix('medical-reports')->name('medical-reports.')->group(function () {

        // List & View Reports
        Route::get('/', [MedicalReportController::class, 'adminIndex'])->name('index');
        Route::get('/{id}', [MedicalReportController::class, 'show'])->name('show');

        // Update Report Status & Analysis
        Route::patch('/{id}/status', [MedicalReportController::class, 'updateStatus'])->name('update-status');

        // Delete Report
        Route::delete('/{id}', [MedicalReportController::class, 'destroy'])->name('destroy');
    });
});

// Legal Pages - Moved to Controller
Route::get('/terms', [LegalController::class, 'terms'])->name('terms');
Route::get('/privacy', [LegalController::class, 'privacy'])->name('privacy');
Route::get('/disclaimer', [LegalController::class, 'disclaimer'])->name('disclaimer');

// Login Routes (available to guests only)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [UserRegistrationController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [UserRegistrationController::class, 'register']);
});

// Logout Route (available to authenticated users only)
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard Route (for authenticated users) - Moved to Controller
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin routes - Moved to Controller
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    });

    // Patient routes - Moved to Controller
    Route::middleware(['auth'])->prefix('patient')->name('patient.')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'patientDashboard'])->name('dashboard');
    });
});

Route::middleware(['auth'])->group(function () {

    // Medical Reports routes
    Route::get('/medical-reports', [App\Http\Controllers\MedicalReportsController::class, 'index'])
        ->name('medical-reports.index');

    Route::get('/medical-reports/upload', [App\Http\Controllers\MedicalReportsController::class, 'create'])
        ->name('medical-reports.upload');

    Route::post('/medical-reports', [App\Http\Controllers\MedicalReportsController::class, 'store'])
        ->name('medical-reports.store');

    // Route::get('/medical-reports/{id}', [App\Http\Controllers\MedicalReportsController::class, 'show'])
    //     ->name('medical-reports.show');

    Route::get('/medical-reports/{id}/download/{index}', [App\Http\Controllers\MedicalReportsController::class, 'download'])
        ->name('medical-reports.download');

    Route::get('/medical-reports/{id}/download-pdf', [App\Http\Controllers\MedicalReportsController::class, 'downloadPdf'])
        ->name('medical-reports.download-pdf');

    // Admin only routes for analysis management - Using custom middleware
    Route::patch('/medical-reports/{id}/update-analysis', [App\Http\Controllers\MedicalReportsController::class, 'updateAnalysis'])
        ->name('medical-reports.update-analysis')
        ->middleware('admin');

    Route::patch('/medical-reports/{id}/update-status', [App\Http\Controllers\MedicalReportsController::class, 'updateStatus'])
        ->name('medical-reports.update-status')
        ->middleware('admin');
});
