<!DOCTYPE html>
<html>
<head>
    <title>Medical Report Submission - {{ $contactData['patient_name'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .info-row {
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .status {
            padding: 5px 10px;
            border-radius: 3px;
            display: inline-block;
            margin-top: 5px;
        }
        .status.pending { background-color: #fff3cd; color: #856404; }
        .status.completed { background-color: #d4edda; color: #155724; }
        .status.analyzing { background-color: #cce7ff; color: #004085; }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #eee;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Medical Report Submission Details</h1>
        <p>Thank you for submitting your medical reports to Report Analysis Expert.</p>
    </div>

    <div class="info-row">
        <span class="label">Patient Name:</span> {{ $contactData['patient_name'] }}
    </div>

    <div class="info-row">
        <span class="label">Email:</span> {{ $contactData['email'] }}
    </div>

    <div class="info-row">
        <span class="label">Phone Number:</span> {{ $contactData['phone_number'] ?? 'Not provided' }}
    </div>

    <div class="info-row">
        <span class="label">Age:</span> {{ $contactData['age'] }} years
    </div>

    <div class="info-row">
        <span class="label">Report Type:</span> {{ ucwords(str_replace('_', ' ', $contactData['report_type'])) }}
    </div>

    @if(!empty($contactData['symptoms']))
    <div class="info-row">
        <span class="label">Symptoms:</span> {{ $contactData['symptoms'] }}
    </div>
    @endif

    @if(!empty($contactData['medical_history']))
    <div class="info-row">
        <span class="label">Medical History:</span> {{ $contactData['medical_history'] }}
    </div>
    @endif

    <div class="info-row">
        <span class="label">Urgency Level:</span>
        <span class="status {{ $contactData['urgency_level'] }}">
            {{ ucfirst($contactData['urgency_level']) }}
        </span>
    </div>

    <div class="info-row">
        <span class="label">Status:</span>
        <span class="status {{ $contactData['status'] }}">
            {{ ucfirst($contactData['status']) }}
        </span>
    </div>

    @if(isset($contactData['report_id']))
    <div class="info-row">
        <span class="label">Report ID:</span> #{{ $contactData['report_id'] }}
    </div>
    @endif

    @if(!empty($contactData['analysis_result']))
    <div class="info-row">
        <span class="label">Analysis Result:</span><br>
        <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin-top: 10px;">
            {{ $contactData['analysis_result'] }}
        </div>
    </div>
    @endif

    @if(isset($contactData['file_attachments']) && count($contactData['file_attachments']) > 0)
    <div class="info-row">
        <span class="label">Attached Files:</span>
        <ul style="margin-top: 10px;">
            @foreach($contactData['file_attachments'] as $file)
                <li>{{ $file['name'] }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="footer">
        <p><strong>Report Analysis Expert</strong></p>
        <p>This is an automated email. Please do not reply to this email address.</p>
        <p>For any questions, please contact our support team.</p>
    </div>
</body>
</html>
