{{-- ========================================
SUCCESS VIEW
resources/views/medical-reports/success.blade.php
======================================== --}}

@extends('layout.master')

@section('title', 'Upload Successful')

@section('content')
<section class="contact_section layout_padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="success_container text-center">
          <div class="success_icon">
            <i class="fa fa-check-circle text-success" style="font-size: 80px;"></i>
          </div>

          <h2 class="mt-4">Upload Successful!</h2>
          <p class="lead">Your medical reports have been uploaded successfully.</p>

          <div class="report_details bg-light p-4 rounded mt-4">
            <h4>Report Details</h4>
            <div class="row">
              <div class="col-md-6">
                <p><strong>Patient Name:</strong> {{ $report->patient_name }}</p>
                <p><strong>Report Type:</strong> {{ $report->report_type_name }}</p>
                <p><strong>Files Uploaded:</strong> {{ $report->getFileCount() }} files</p>
              </div>
              <div class="col-md-6">
                <p><strong>Priority:</strong> {{ $report->urgency_level_name }}</p>
                <p><strong>Analysis Fee:</strong> PKR {{ number_format($report->price, 2) }}</p>
                <p><strong>Status:</strong> {{ $report->status_name }}</p>
              </div>
            </div>
          </div>

          <div class="next_steps mt-4">
            <h5>What happens next?</h5>
            <ol class="text-left">
              <li>You will receive a confirmation email with report details</li>
              <li>Our medical experts will review your reports</li>
              <li>Analysis will be completed within the specified timeframe</li>
              <li>You'll receive your detailed analysis report via email</li>
            </ol>
          </div>

          <div class="action_buttons mt-4">
            <a href="{{ route('medical-reports.show', $report->id) }}" class="btn btn-primary">
              <i class="fa fa-eye"></i> View Report Details
            </a>
            <a href="{{ route('medical-reports.upload') }}" class="btn btn-outline-primary">
              <i class="fa fa-plus"></i> Upload Another Report
            </a>
          </div>

          <div class="contact_info mt-4 p-3 bg-info text-white rounded">
            <h6>Need Help?</h6>
            <p class="mb-0">Contact us at <strong>+92-315-8274326</strong> or <strong>labreportanalyst@gmail.com</strong></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
