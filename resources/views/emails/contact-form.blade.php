<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Form Submission</title>
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
        .content {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #e9ecef;
            border-radius: 5px;
        }
        .field {
            margin-bottom: 15px;
        }
        .field-label {
            font-weight: bold;
            color: #495057;
            margin-bottom: 5px;
        }
        .field-value {
            padding: 8px;
            background-color: #f8f9fa;
            border-radius: 3px;
        }
        .message-field {
            min-height: 100px;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>New Contact Form Submission</h2>
        <p>You have received a new message from your website contact form.</p>
    </div>

    <div class="content">
        <div class="field">
            <div class="field-label">Name:</div>
            <div class="field-value">{{ $name }}</div>
        </div>

        <div class="field">
            <div class="field-label">Email:</div>
            <div class="field-value">{{ $email }}</div>
        </div>

        <div class="field">
            <div class="field-label">Phone:</div>
            <div class="field-value">{{ $phone }}</div>
        </div>

        <div class="field">
            <div class="field-label">Message:</div>
            <div class="field-value message-field">{{ $contactmessage }}</div>
        </div>
    </div>

    <div style="margin-top: 20px; padding: 15px; background-color: #e9ecef; border-radius: 5px; font-size: 12px; color: #6c757d;">
        <p>This email was sent from your website contact form on {{ date('F j, Y \a\t g:i A') }}.</p>
    </div>
</body>
</html>
