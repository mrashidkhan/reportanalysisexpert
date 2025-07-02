{{-- ========================================
SHOW VIEW
resources/views/medical-reports/show.blade.php
======================================== --}}

@extends('layout.master')

@section('title', 'Report Details')

@section('content')
    <section class="contact_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="report_details_container">
                        <h2>Medical Report Details</h2>

                        <div class="patient_info bg-light p-4 rounded mb-4">
                            <h4>Patient Information</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> {{ $report->patient_name }}</p>
                                    <p><strong>Age:</strong> {{ $report->age }} years</p>
                                    <p><strong>Email:</strong> {{ $report->email }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Phone:</strong> {{ $report->phone_number }}</p>
                                    <p><strong>Report Type:</strong> {{ $report->report_type_name }}</p>
                                    <p><strong>Upload Date:</strong> {{ $report->created_at->format('M d, Y h:i A') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="report_status bg-white border p-4 rounded mb-4">
                            <h4>Report Status</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Current Status:</strong>
                                        <span
                                            class="badge badge-{{ $report->status == 'completed' ? 'success' : ($report->status == 'analyzing' ? 'warning' : 'secondary') }}">
                                            {{ $report->status_name }}
                                        </span>
                                    </p>
                                    <p><strong>Priority Level:</strong> {{ $report->urgency_level_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Analysis Fee:</strong> PKR {{ number_format($report->price, 2) }}</p>
                                    @if ($report->analyzed_at)
                                        <p><strong>Analyzed On:</strong> {{ $report->analyzed_at->format('M d, Y h:i A') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if ($report->symptoms || $report->medical_history)
                            <div class="additional_info bg-light p-4 rounded mb-4">
                                <h4>Additional Information</h4>
                                @if ($report->symptoms)
                                    <div class="mb-3">
                                        <strong>Symptoms:</strong>
                                        <p>{{ $report->symptoms }}</p>
                                    </div>
                                @endif
                                @if ($report->medical_history)
                                    <div>
                                        <strong>Medical History:</strong>
                                        <p>{{ $report->medical_history }}</p>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <div class="uploaded_files bg-white border p-4 rounded mb-4">
                            <h4>Uploaded Files ({{ $report->getFileCount() }})</h4>
                            <div class="files_list">
                                @foreach ($report->file_paths as $index => $filePath)
                                    <div
                                        class="file_item d-flex justify-content-between align-items-center p-2 border-bottom">
                                        <div>
                                            <i class="fa fa-file-o mr-2"></i>
                                            <span>{{ basename($filePath) }}</span>
                                        </div>
                                        <a href="{{ route('medical-reports.download', [$report->id, $index]) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Analysis Result Section --}}
                        @if ($report->analysis_result)
                            <div class="analysis_result bg-success text-white p-4 rounded mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="mb-0">Analysis Result</h4>
                                    @if (auth()->user()->role === 'admin')
                                        <button class="btn btn-sm btn-light text-dark" onclick="toggleEditMode()">
                                            <i class="fa fa-edit"></i> Edit Analysis
                                        </button>
                                    @endif
                                </div>

                                {{-- Display Mode --}}
                                <div id="analysis-display" class="result_content">
                                    {!! nl2br(e($report->analysis_result)) !!}
                                </div>

                                {{-- Edit Mode (Admin Only) --}}
                                @if (auth()->user()->role === 'admin')
                                    <div id="analysis-edit" style="display: none;">
                                        <form action="{{ route('medical-reports.update-analysis', $report->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group">
                                                <textarea name="analysis_result" class="form-control" rows="10"
                                                    placeholder="Enter analysis result..." required>{{ $report->analysis_result }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-light text-dark">
                                                    <i class="fa fa-save"></i> Save Analysis
                                                </button>
                                                <button type="button" class="btn btn-outline-light" onclick="cancelEdit()">
                                                    <i class="fa fa-times"></i> Cancel
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endif

                                @if ($report->analyzer)
                                    <small class="d-block mt-3">
                                        <strong>Analyzed by:</strong> {{ $report->analyzer }}
                                    </small>
                                @endif
                                @if ($report->analyzed_at)
                                    <small class="d-block">
                                        <strong>Last Updated:</strong> {{ $report->analyzed_at->format('M d, Y h:i A') }}
                                    </small>
                                @endif
                            </div>
                        @else
                            {{-- No Analysis Result - Admin can add one --}}
                            @if (auth()->user()->role === 'admin')
                                <div class="analysis_form bg-primary text-white p-4 rounded mb-4">
                                    <h4><i class="fa fa-plus-circle"></i> Add Analysis Result</h4>
                                    <form action="{{ route('medical-reports.update-analysis', $report->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <label for="analysis_result" class="text-white">Analysis Result:</label>
                                            <textarea name="analysis_result" id="analysis_result" class="form-control" rows="8"
                                                placeholder="Enter detailed analysis result..." required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-light text-dark">
                                                <i class="fa fa-save"></i> Save Analysis
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                {{-- Patient View - Analysis Pending --}}
                                <div class="analysis_pending bg-warning text-dark p-4 rounded mb-4">
                                    <h4><i class="fa fa-clock-o"></i> Analysis Pending</h4>
                                    <p class="mb-0">Your medical report is currently being analyzed by our medical experts.
                                        You will receive the analysis results via email once completed.</p>
                                    @if ($report->status == 'analyzing')
                                        <div class="progress mt-3">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                role="progressbar" style="width: 60%">
                                                Analysis in Progress
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endif

                        <!-- Action Buttons -->
                        <div class="action_buttons">
                            <a href="{{ route('medical-reports.upload') }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Upload New Report
                            </a>
                            @if ($report->analysis_result)
                                <button class="btn btn-outline-success" onclick="printReport()">
                                    <i class="fa fa-print"></i> Print Report
                                </button>
                                <a href="{{ route('medical-reports.download-pdf', $report->id) }}"
                                    class="btn btn-outline-info">
                                    <i class="fa fa-file-pdf-o"></i> Download PDF
                                </a>
                            @endif
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('medical-reports.index') }}" class="btn btn-outline-secondary">
                                    <i class="fa fa-list"></i> Back to Reports List
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="sidebar_container">
                        <!-- Report Summary -->
                        <div class="summary_card bg-light p-4 rounded mb-4">
                            <h5>Report Summary</h5>
                            <ul class="list-unstyled">
                                <li><strong>Report ID:</strong> #{{ $report->id }}</li>
                                <li><strong>Type:</strong> {{ $report->report_type_name }}</li>
                                <li><strong>Status:</strong> {{ $report->status_name }}</li>
                                <li><strong>Priority:</strong> {{ $report->urgency_level_name }}</li>
                                <li><strong>Files:</strong> {{ $report->getFileCount() }}</li>
                            </ul>
                        </div>

                        {{-- Admin Controls --}}
                        @if (auth()->user()->role === 'admin')
                            <div class="admin_controls bg-dark text-white p-4 rounded mb-4">
                                <h5><i class="fa fa-user-md"></i> Admin Controls</h5>
                                <div class="btn-group-vertical w-100">
                                    @if (!$report->analysis_result)
                                        <button class="btn btn-outline-light btn-sm mb-2" onclick="scrollToAnalysisForm()">
                                            <i class="fa fa-plus"></i> Add Analysis
                                        </button>
                                    @else
                                        <button class="btn btn-outline-light btn-sm mb-2" onclick="toggleEditMode()">
                                            <i class="fa fa-edit"></i> Edit Analysis
                                        </button>
                                    @endif
                                    <form action="{{ route('medical-reports.update-status', $report->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-control form-control-sm mb-2" onchange="this.form.submit()">
                                            <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="analyzing" {{ $report->status == 'analyzing' ? 'selected' : '' }}>Analyzing</option>
                                            <option value="completed" {{ $report->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        @endif

                        <!-- Contact Information -->
                        <div class="contact_card bg-info text-white p-4 rounded mb-4">
                            <h5><i class="fa fa-phone"></i> Need Help?</h5>
                            <p class="mb-2">For any queries regarding your report:</p>
                            <ul class="list-unstyled">
                                <li><strong>Phone:</strong> +92-315-8274326</li>
                                <li><strong>Email:</strong> labreportanalyst@gmail.com</li>
                                <li><strong>Hours:</strong> 24/7 Support</li>
                            </ul>
                        </div>

                        <!-- Emergency Notice -->
                        @if ($report->urgency_level == 'emergency')
                            <div class="emergency_notice bg-danger text-white p-4 rounded mb-4">
                                <h6><i class="fa fa-exclamation-triangle"></i> Emergency Report</h6>
                                <p class="mb-0">This report has been marked as emergency priority.
                                    Our medical team will analyze it within 2 hours.</p>
                            </div>
                        @endif

                        <!-- Next Steps -->
                        @if (!$report->analysis_result && auth()->user()->role !== 'admin')
                            <div class="next_steps bg-white border p-4 rounded">
                                <h5>What's Next?</h5>
                                <ol class="small">
                                    <li>Your report is being reviewed by our medical experts</li>
                                    <li>Analysis will be completed based on priority level</li>
                                    <li>You'll receive email notification when ready</li>
                                    <li>Detailed analysis will be available on this page</li>
                                </ol>

                                <div class="estimated_time mt-3 p-2 bg-light rounded">
                                    <small>
                                        <strong>Estimated Completion:</strong>
                                        @if ($report->urgency_level == 'emergency')
                                            Within 2 hours
                                        @elseif($report->urgency_level == 'urgent')
                                            Within 12 hours
                                        @else
                                            24-48 hours
                                        @endif
                                    </small>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Print Styles -->
    <style>
        @media print {

            .sidebar_container,
            .action_buttons,
            .btn,
            #analysis-edit {
                display: none !important;
            }

            .report_details_container {
                width: 100% !important;
            }

            .bg-success,
            .bg-light,
            .bg-white {
                background: white !important;
                color: black !important;
            }

            .border {
                border: 1px solid #ccc !important;
            }
        }
    </style>

    <!-- JavaScript -->
    <script>
        function printReport() {
            window.print();
        }

        // Toggle edit mode for analysis result (Admin only)
        function toggleEditMode() {
            const displayDiv = document.getElementById('analysis-display');
            const editDiv = document.getElementById('analysis-edit');

            if (editDiv.style.display === 'none') {
                displayDiv.style.display = 'none';
                editDiv.style.display = 'block';
            } else {
                displayDiv.style.display = 'block';
                editDiv.style.display = 'none';
            }
        }

        // Cancel edit mode
        function cancelEdit() {
            const displayDiv = document.getElementById('analysis-display');
            const editDiv = document.getElementById('analysis-edit');

            displayDiv.style.display = 'block';
            editDiv.style.display = 'none';
        }

        // Scroll to analysis form
        function scrollToAnalysisForm() {
            const analysisForm = document.querySelector('.analysis_form');
            if (analysisForm) {
                analysisForm.scrollIntoView({ behavior: 'smooth' });
                const textarea = analysisForm.querySelector('textarea');
                if (textarea) {
                    textarea.focus();
                }
            }
        }

        // Auto-refresh for pending reports (patients only)
        @if (!$report->analysis_result && $report->status == 'analyzing' && auth()->user()->role !== 'admin')
            setTimeout(function() {
                location.reload();
            }, 30000); // Refresh every 30 seconds
        @endif

        // Show success message if analysis was updated
        @if (session('success'))
            alert('{{ session('success') }}');
        @endif
    </script>
@endsection
