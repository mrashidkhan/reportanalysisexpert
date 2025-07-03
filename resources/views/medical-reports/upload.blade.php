{{-- ========================================
UPLOAD VIEW
resources/views/medical-reports/upload.blade.php
======================================== --}}

@extends('layout.master')

@section('title', 'Upload Medical Reports')

@section('content')
<!-- report upload section -->
<section class="contact_section layout_padding">
  <div class="container">
    <div class="heading_container">
      <h2>Upload Your Medical Reports</h2>
      <p>Upload your Blood Reports, X-Rays, MRI, and Ultrasound results for expert analysis</p>
    </div>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="row">
      <div class="col-12 col-md-8">
        <div class="form_container contact-form">
          <form action="{{ route('medical-reports.upload') }}" method="POST" enctype="multipart/form-data" id="reportUploadForm">
            @csrf

            <!-- Patient Information -->

            <!-- Hidden field for authenticated user ID -->
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <div class="form-row">
              <div class="col-lg-6">
                <div>
                  <input type="text" name="patient_name" placeholder="Patient Name"
                         value="{{ old('patient_name') }}" required />
                  @error('patient_name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div>
                  <input type="text" name="phone_number" placeholder="Phone Number"
                         value="{{ old('phone_number') }}" required />
                  @error('phone_number')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col-lg-6">
                <div>
                  <input type="email" name="email" placeholder="Email Address"
                         value="{{ old('email') }}" required />
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div>
                  <input type="number" name="age" placeholder="Patient Age"
                         min="1" max="120" value="{{ old('age') }}" required />
                  @error('age')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Report Type Selection -->
            <div class="mb-4">
              <select name="report_type" required class="form-control">
                <option value="">Select Report Type</option>
                <option value="blood_report" {{ old('report_type') == 'blood_report' ? 'selected' : '' }}>Blood Report</option>
                <option value="xray" {{ old('report_type') == 'xray' ? 'selected' : '' }}>X-Ray</option>
                <option value="mri" {{ old('report_type') == 'mri' ? 'selected' : '' }}>MRI Scan</option>
                <option value="ultrasound" {{ old('report_type') == 'ultrasound' ? 'selected' : '' }}>Ultrasound</option>
                <option value="ct_scan" {{ old('report_type') == 'ct_scan' ? 'selected' : '' }}>CT Scan</option>
                <option value="other" {{ old('report_type') == 'other' ? 'selected' : '' }}>Other</option>
              </select>
              @error('report_type')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <!-- File Upload Section -->
            <div class="file-upload-section">
              <label for="medical_reports" class="file-upload-label">
                <i class="fa fa-cloud-upload"></i>
                <span>Click to upload medical reports</span>
                <small>Supported formats: PDF, JPG, PNG, DICOM (Max: 10MB per file, 5 files maximum)</small>
              </label>
              <input type="file" name="medical_reports[]" id="medical_reports"
                     multiple accept=".pdf,.jpg,.jpeg,.png,.dicom,.dcm"
                     class="file-input mt-2" required />
              @error('medical_reports')
                <span class="text-danger">{{ $message }}</span>
              @enderror
              @error('medical_reports.*')
                <span class="text-danger">{{ $message }}</span>
              @enderror
              <div id="file-preview" class="file-preview"></div>
            </div>

            <!-- Additional Information -->
            <div class="mb-2 ">
              <textarea name="symptoms" class="message-box col-12 " placeholder="Describe your symptoms or concerns (Optional)"
                        rows="4">{{ old('symptoms') }}</textarea>
              @error('symptoms')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-2 ">
              <textarea name="medical_history" class="message-box col-12" placeholder="Brief medical history (Optional)"
                        rows="3">{{ old('medical_history') }}</textarea>
              @error('medical_history')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <!-- Urgency Level -->
            <div class="mb-2 ">
              <select name="urgency_level" class="form-control">
                <option value="normal" {{ old('urgency_level') == 'normal' ? 'selected' : '' }}>
                  Normal Priority (24-48 hours)
                </option>
                <option value="urgent" {{ old('urgency_level') == 'urgent' ? 'selected' : '' }}>
                  Urgent (Within 12 hours) - Additional charges apply
                </option>
                <option value="emergency" {{ old('urgency_level') == 'emergency' ? 'selected' : '' }}>
                  Emergency (Within 2 hours) - Premium charges apply
                </option>
              </select>
            </div>

            <!-- Terms and Conditions -->
            <div class="form-check mb-2">
              <input type="checkbox" name="terms_accepted" id="terms_accepted"
                     class="form-check-input" {{ old('terms_accepted') ? 'checked' : '' }} required />
              <label class="form-check-label" for="terms_accepted">
                I agree to the <a href="{{ route('terms') }}" target="_blank">Terms & Conditions</a> and
                <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a>
              </label>
              @error('terms_accepted')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="btn_box mb-2 mt-5">
              <button type="submit" id="submitBtn">
                <i class="fa fa-upload"></i> UPLOAD REPORTS
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Information Panel -->
      <div class="col-md-4">
        <div class="info_container">
          <div class="info_item">
            <div class="info_icon">
              <i class="fa fa-clock-o"></i>
            </div>
            <div class="info_content">
              <h5>Quick Analysis</h5>
              <p>Get your report analysis within 24-48 hours</p>
            </div>
          </div>

          <div class="info_item">
            <div class="info_icon">
              <i class="fa fa-user-md"></i>
            </div>
            <div class="info_content">
              <h5>Expert Doctors</h5>
              <p>Certified medical professionals with 10+ years experience</p>
            </div>
          </div>

          <div class="info_item">
            <div class="info_icon">
              <i class="fa fa-shield"></i>
            </div>
            <div class="info_content">
              <h5>Secure & Confidential</h5>
              <p>Your medical data is encrypted and completely confidential</p>
            </div>
          </div>

          <!-- Pricing Info -->
          <div class="pricing_info">
            <h5>Analysis Pricing</h5>
            <ul>
              <li>Blood Reports: PKR 200/- per report</li>
              <li>X-Ray Analysis: PKR 300/- per report</li>
              <li>MRI/CT Scan: PKR 400 per report</li>
              <li>Ultrasound: PKR 350/- per report</li>
            </ul>
            <small>*Urgent and Emergency priorities have additional charges</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- @include('medical-reports.partials.upload-scripts') --}}
@endsection
