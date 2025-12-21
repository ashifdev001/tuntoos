<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Purchase Confirmation</title>
</head>

<body>
    <h1>Event Purchase Confirmation</h1>
    <p>Dear {{ $userData['name'] }},</p>
    <p>Thank you for purchasing a ticket for the event "<strong>{{ $userData['event_name'] }}</strong>". We are excited
        to have you join us.</p>
    <p>Here are the details of your purchase:</p>
    <p><strong>Event:</strong> {{ $userData['event_name'] }}</p>
    <p><strong>Amount Paid:</strong> ${{ $userData['amount'] }}</p>
    <p>We look forward to seeing you at the event. If you have any questions or need further assistance, please feel
        free to contact us.</p>
    <p>Thank you for your support.</p>
    <p>Best regards,<br>{{ env('APP_NAME') }}</p>
</body>

</html>
