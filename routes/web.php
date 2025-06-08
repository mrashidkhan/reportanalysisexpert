<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MedicalReportController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/contactus', [PageController::class, 'contactus'])->name('contactus');
Route::get('/aboutus', [PageController::class, 'aboutus'])->name('aboutus');
Route::get('/departments', [PageController::class, 'departments'])->name('departments');
Route::get('/doctors', [PageController::class, 'doctors'])->name('doctors');
Route::get('/reportsupload', [PageController::class, 'reportsupload'])->name('reports.upload');
// Route::get('/doctors', [PageController::class, 'doctors'])->name('terms');

// ========================================
// MEDICAL REPORTS ROUTES
// routes/web.php
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

// API Routes for Dashboard Statistics
Route::middleware(['auth', 'role:admin'])->prefix('api')->name('api.')->group(function () {
    Route::get('/medical-reports/stats', [MedicalReportController::class, 'getStats'])
        ->name('medical-reports.stats');
});

// Additional Supporting Routes (if needed)
Route::get('/terms', function () {
    return view('legal.terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('legal.privacy');
})->name('privacy');

// Home/Landing Page Route
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Dashboard Route (for authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
