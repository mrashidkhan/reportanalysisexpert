<?php

// ========================================
// CONTROLLER
// app/Http/Controllers/MedicalReportController.php
// ========================================

namespace App\Http\Controllers;

use App\Models\MedicalReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
// use App\Mail\ReportUploadConfirmation;
// use App\Mail\ReportAnalysisComplete;
use App\Mail\ContactMail;

class MedicalReportController extends Controller
{
    public function index()
    {
        return view('medical-reports.upload');
    }

    public function upload(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'patient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'age' => 'required|integer|min:1|max:120',
            'report_type' => 'required|in:blood_report,xray,mri,ultrasound,ct_scan,other',
            'medical_reports' => 'required|array|min:1|max:5',
            'medical_reports.*' => 'file|mimes:pdf,jpg,jpeg,png,dcm,dicom|max:10240', // 10MB max
            'symptoms' => 'nullable|string|max:1000',
            'medical_history' => 'nullable|string|max:1000',
            'urgency_level' => 'required|in:normal,urgent,emergency',
            'terms_accepted' => 'required|accepted'
        ], [
            'medical_reports.required' => 'Please upload at least one medical report.',
            'medical_reports.*.mimes' => 'Only PDF, JPG, PNG, and DICOM files are allowed.',
            'medical_reports.*.max' => 'Each file must be less than 10MB.',
            'terms_accepted.accepted' => 'You must accept the terms and conditions.'
        ]);

        try {
            // Create directory for this patient's reports
            $patientFolder = 'medical-reports/' . date('Y/m/d') . '/' . Str::random(10);

            // Store uploaded files
            $filePaths = [];
            foreach ($request->file('medical_reports') as $file) {
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . Str::random(5) . '_' . $originalName;
                $path = $file->storeAs($patientFolder, $filename, 'public');
               // $path = $file->store($patientFolder, 'public');
                $filePaths[] = $path;
            }

            // Create medical report record
            $medicalReport = MedicalReport::create([
                'patient_name' => $validated['patient_name'],
                'phone_number' => $validated['phone_number'],
                'email' => $validated['email'],
                'age' => $validated['age'],
                'report_type' => $validated['report_type'],
                'file_paths' => $filePaths,
                'symptoms' => $validated['symptoms'],
                'medical_history' => $validated['medical_history'],
                'urgency_level' => $validated['urgency_level'],
                'terms_accepted' => true,
                'status' => 'pending'
            ]);

            // Calculate and update price
            $price = $medicalReport->calculatePrice();
            $medicalReport->update(['price' => $price]);

            $contactData = [
        'patient_name' => $validated['patient_name'],
        'phone_number' => $validated['phone_number'],
        'email' => $request->input('email'),
        'age' => $request->input('age'),
        'report_type' => $request->input('report_type'),
        'file_paths' => $request->input('$filePaths'),
        'symptoms' => $request->input('symptoms'),
        'medical_history' => $request->input('medical_history'),
        'urgency_level' => $request->input('urgency_level'),
        'status' => $request->input('status'),

    ];

            // Send confirmation email
            try {
                // Mail::to($validated['email'])->send(new ReportUploadConfirmation($medicalReport));
                Mail::to("muhammadrashidkhan800@gmail.com")->send(new ContactMail($contactData));
                Mail::to($validated['email'])->send(new ContactMail($contactData));
                // Mail::to($medicalReport->email)->send(new ContactMail($medicalReport));
            } catch (\Exception $e) {
                \Log::error('Failed to send confirmation email: ' . $e->getMessage());
            }

            return redirect()->route('medical-reports.success', $medicalReport->id)
                           ->with('success', 'Medical reports uploaded successfully!');

        } catch (\Exception $e) {
            \Log::error('Medical report upload failed: ' . $e->getMessage());

            // Clean up any uploaded files on error
            if (isset($filePaths)) {
                foreach ($filePaths as $path) {
                    Storage::disk('private')->delete($path);
                }
            }

            return back()->withInput()->withErrors(['error' => 'Failed to upload reports. Please try again.']);
        }
    }

    public function success($id)
    {
        $report = MedicalReport::findOrFail($id);
        return view('medical-reports.success', compact('report'));
    }

    public function show($id)
    {
        $report = MedicalReport::findOrFail($id);
        return view('medical-reports.show', compact('report'));
    }

    public function downloadFile($reportId, $fileIndex)
    {
        $report = MedicalReport::findOrFail($reportId);

        if (!isset($report->file_paths[$fileIndex])) {
            abort(404, 'File not found');
        }

        $filePath = $report->file_paths[$fileIndex];

        if (!Storage::disk('private')->exists($filePath)) {
            abort(404, 'File not found on server');
        }

        return Storage::disk('private')->download($filePath);
    }

    public function adminIndex()
    {
        $reports = MedicalReport::with('analyzer')
                               ->orderByRaw("FIELD(urgency_level, 'emergency', 'urgent', 'normal')")
                               ->orderByRaw("FIELD(status, 'pending', 'analyzing', 'completed')")
                               ->orderBy('created_at', 'desc')
                               ->paginate(20);

        return view('admin.medical-reports.index', compact('reports'));
    }

    public function updateStatus(Request $request, $id)
    {
        $report = MedicalReport::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,analyzing,completed,cancelled',
            'analysis_result' => 'nullable|string|max:5000'
        ]);

        $report->update([
            'status' => $validated['status'],
            'analysis_result' => $validated['analysis_result'],
            'analyzed_at' => $validated['status'] === 'completed' ? now() : null,
            'analyzed_by' => $validated['status'] === 'completed' ? auth()->id() : null
        ]);

        // Send completion email if analysis is complete
        if ($validated['status'] === 'completed' && $validated['analysis_result']) {
            try {
                // Mail::to($report->email)->send(new ReportAnalysisComplete($report));
                // Send the email
                Mail::to("mrashid2000@gmail.com")->send(new ContactMail($contactData));
            } catch (\Exception $e) {
                \Log::error('Failed to send analysis completion email: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Report status updated successfully!');
    }

    public function destroy($id)
    {
        $report = MedicalReport::findOrFail($id);

        // Delete associated files
        foreach ($report->file_paths as $filePath) {
            Storage::disk('private')->delete($filePath);
        }

        $report->delete();

        return back()->with('success', 'Medical report deleted successfully!');
    }

    // API Methods for Dashboard
    public function getStats()
    {
        return response()->json([
            'total_reports' => MedicalReport::count(),
            'pending_reports' => MedicalReport::where('status', 'pending')->count(),
            'completed_reports' => MedicalReport::where('status', 'completed')->count(),
            'urgent_reports' => MedicalReport::whereIn('urgency_level', ['urgent', 'emergency'])->count(),
            'revenue_this_month' => MedicalReport::where('payment_status', 'paid')
                                                ->whereMonth('created_at', now()->month)
                                                ->sum('price')
        ]);
    }
}
