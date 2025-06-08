<!-- report upload section -->
<section class="contact_section layout_padding">
  <div class="container">
    <div class="heading_container">
      <h2>
        Upload Your Medical Reports
      </h2>
      <p>
        Upload your Blood Reports, X-Rays, MRI, and Ultrasound results for expert analysis
      </p>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="form_container contact-form">
          <form action="{{ route('report.upload') }}" method="POST" enctype="multipart/form-data" id="reportUploadForm">
            @csrf

            <!-- Patient Information -->
            <div class="form-row">
              <div class="col-lg-6">
                <div>
                  <input type="text" name="patient_name" placeholder="Patient Name" required />
                  @error('patient_name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div>
                  <input type="text" name="phone_number" placeholder="Phone Number" required />
                  @error('phone_number')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col-lg-6">
                <div>
                  <input type="email" name="email" placeholder="Email Address" required />
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div>
                  <input type="number" name="age" placeholder="Patient Age" min="1" max="120" required />
                  @error('age')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Report Type Selection -->
            <div>
              <select name="report_type" required class="form-control">
                <option value="">Select Report Type</option>
                <option value="blood_report">Blood Report</option>
                <option value="xray">X-Ray</option>
                <option value="mri">MRI Scan</option>
                <option value="ultrasound">Ultrasound</option>
                <option value="ct_scan">CT Scan</option>
                <option value="other">Other</option>
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
                <small>Supported formats: PDF, JPG, PNG, DICOM (Max: 10MB per file)</small>
              </label>
              <input type="file" name="medical_reports[]" id="medical_reports"
                     multiple accept=".pdf,.jpg,.jpeg,.png,.dicom,.dcm"
                     class="file-input" required />
              @error('medical_reports')
                <span class="text-danger">{{ $message }}</span>
              @enderror
              <div id="file-preview" class="file-preview"></div>
            </div>

            <!-- Additional Information -->
            <div>
              <textarea name="symptoms" class="message-box" placeholder="Describe your symptoms or concerns (Optional)" rows="4"></textarea>
              @error('symptoms')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div>
              <textarea name="medical_history" class="message-box" placeholder="Brief medical history (Optional)" rows="3"></textarea>
              @error('medical_history')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <!-- Urgency Level -->
            <div>
              <select name="urgency_level" class="form-control">
                <option value="normal">Normal Priority (24-48 hours)</option>
                <option value="urgent">Urgent (Within 12 hours) - Additional charges apply</option>
                <option value="emergency">Emergency (Within 2 hours) - Premium charges apply</option>
              </select>
            </div>

            <!-- Terms and Conditions -->
            <div class="form-check">
              <input type="checkbox" name="terms_accepted" id="terms_accepted" class="form-check-input" required />
              <label class="form-check-label" for="terms_accepted">
                I agree to the <a href="{{ route('terms') }}" target="_blank">Terms & Conditions</a> and
                <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a>
              </label>
            </div>

            <div class="btn_box">
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

          <div class="info_item">
            <div class="info_icon">
              <i class="fa fa-phone"></i>
            </div>
            <div class="info_content">
              <h5>24/7 Support</h5>
              <p>Call us at +92-XXX-XXXXXXX for any assistance</p>
            </div>
          </div>

          <!-- Pricing Info -->
          <div class="pricing_info">
            <h5>Analysis Pricing</h5>
            <ul>
              <li>Blood Reports: PKR 1,500</li>
              <li>X-Ray Analysis: PKR 2,000</li>
              <li>MRI/CT Scan: PKR 3,500</li>
              <li>Ultrasound: PKR 2,500</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Additional CSS for file upload styling -->
<style>
.file-upload-section {
  margin: 20px 0;
}

.file-upload-label {
  display: block;
  padding: 20px;
  border: 2px dashed #007bff;
  border-radius: 5px;
  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease;
  background-color: #f8f9fa;
}

.file-upload-label:hover {
  border-color: #0056b3;
  background-color: #e9ecef;
}

.file-upload-label i {
  font-size: 24px;
  color: #007bff;
  margin-bottom: 10px;
  display: block;
}

.file-upload-label span {
  display: block;
  font-weight: 600;
  color: #333;
  margin-bottom: 5px;
}

.file-upload-label small {
  color: #666;
  font-size: 12px;
}

.file-input {
  display: none;
}

.file-preview {
  margin-top: 15px;
}

.file-item {
  display: flex;
  align-items: center;
  padding: 10px;
  background-color: #f8f9fa;
  border-radius: 5px;
  margin-bottom: 5px;
}

.file-item i {
  margin-right: 10px;
  color: #007bff;
}

.info_container {
  padding: 20px;
}

.info_item {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  padding: 15px;
  background-color: #f8f9fa;
  border-radius: 5px;
}

.info_icon {
  margin-right: 15px;
}

.info_icon i {
  font-size: 24px;
  color: #007bff;
}

.info_content h5 {
  margin-bottom: 5px;
  color: #333;
}

.info_content p {
  margin: 0;
  color: #666;
  font-size: 14px;
}

.pricing_info {
  background-color: #007bff;
  color: white;
  padding: 20px;
  border-radius: 5px;
  margin-top: 20px;
}

.pricing_info h5 {
  margin-bottom: 15px;
}

.pricing_info ul {
  list-style: none;
  padding: 0;
}

.pricing_info li {
  padding: 5px 0;
  border-bottom: 1px solid rgba(255,255,255,0.2);
}

.form-check {
  margin: 15px 0;
}

.form-check-label {
  margin-left: 25px;
}

.text-danger {
  color: #dc3545;
  font-size: 12px;
  margin-top: 5px;
  display: block;
}

#submitBtn {
  position: relative;
}

#submitBtn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}
</style>

<!-- JavaScript for file handling -->
<script>
document.getElementById('medical_reports').addEventListener('change', function() {
    const filePreview = document.getElementById('file-preview');
    const files = this.files;

    filePreview.innerHTML = '';

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const fileItem = document.createElement('div');
        fileItem.className = 'file-item';

        let iconClass = 'fa-file';
        if (file.type.includes('pdf')) iconClass = 'fa-file-pdf-o';
        else if (file.type.includes('image')) iconClass = 'fa-file-image-o';

        fileItem.innerHTML = `
            <i class="fa ${iconClass}"></i>
            <span>${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)</span>
        `;

        filePreview.appendChild(fileItem);
    }
});

// Form submission handling
document.getElementById('reportUploadForm').addEventListener('submit', function() {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> UPLOADING...';
});
</script>
<!-- end report upload section -->
