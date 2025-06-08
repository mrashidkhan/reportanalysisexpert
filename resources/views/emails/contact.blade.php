<!DOCTYPE html>
<html>
<head>
    <title>New Contact Message from Report Analysis Expert Website</title>
</head>
<body>
    <h1>New Contact Message</h1>
    <p><strong>Full Name:</strong> {{ $medicalReport['patient_name'] }}</p>
    <p><strong>Email:</strong> {{ $medicalReport['email'] }}</p>
    <p><strong>Phone Number:</strong> {{ $medicalReport['phone_number'] ?? 'No Phone provided' }}</p>
    <p><strong>Message:</strong> {{ $medicalReport['age'] }}</p>

    <p><strong>Message:</strong> {{ $medicalReport['report_type'] }}</p>
    <p><strong>Message:</strong> {{ $medicalReport['symptoms'] }}</p>
    <p><strong>Message:</strong> {{ $medicalReport['medical_history'] }}</p>
    <p><strong>Message:</strong> {{ $medicalReport['urgency_level'] }}</p>
</body>
</html>
