<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function updateAnalysis(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'analysis_result' => 'required|string',
        ]);

        // Find the report by ID
        $report = Report::findOrFail($id);

        // Update the analysis result
        $report->analysis_result = $request->input('analysis_result');
        $report->analyzer = Auth::user()->name; // Assign the authenticated user's name
        $report->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Analysis result updated successfully.');
    }
}
