<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Event Purchase</title>
</head>

<body>
    <h1>New Event Purchase</h1>
    <p>Dear Admin,</p>
    <p>We are pleased to inform you that a new purchase has been made for the event
        "<strong>{{ $userData['event_name'] }}</strong>". Below are the details of the purchase:</p>
    <p><strong>Name:</strong> {{ $userData['name'] }}</p>
    <p><strong>Event:</strong> {{ $userData['event_name'] }}</p>
    <p><strong>Amount Paid:</strong> ${{ $userData['amount'] }}</p>
    <p>Please take the necessary actions to process this purchase.</p>
    <p>Thank you for your attention.</p>
    <p>Best regards,<br>{{ env('APP_NAME') }}</p>
</body>

</html>
