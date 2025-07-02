<!DOCTYPE html>
<html>
<head>
    <title>{{ $contactData['patient_name'] }} Information from Report Analysis Expert Website</title>
</head>
<body>
    <h1>Your Medical Report Details</h1>
    <p><strong>Full Name:</strong> {{ $contactData['patient_name'] }}</p>
    <p><strong>Email:</strong> {{ $contactData['email'] }}</p>
    <p><strong>Phone Number:</strong> {{ $contactData['phone_number'] ?? 'No Phone provided' }}</p>
    <p><strong>Message:</strong> {{ $contactData['age'] }}</p>

    <p><strong>Message:</strong> {{ $contactData['report_type'] }}</p>
    <p><strong>Message:</strong> {{ $contactData['symptoms'] }}</p>
    <p><strong>Message:</strong> {{ $contactData['medical_history'] }}</p>
    <p><strong>Message:</strong> {{ $contactData['urgency_level'] }}</p>
</body>
</html>
