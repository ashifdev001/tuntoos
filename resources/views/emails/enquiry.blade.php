<!DOCTYPE html>
<html>

<head>
    <title>Enquiry Received</title>
</head>

<body>
    <h1>New Enquiry Received</h1>

    @if (!empty($enquiry['name']))
        <p><strong>Name:</strong> {{ htmlspecialchars($enquiry['name']) }}</p>
    @endif

    @if (!empty($enquiry['email']))
        <p><strong>Email:</strong> {{ htmlspecialchars($enquiry['email']) }}</p>
    @endif

    @if (!empty($enquiry['phone']))
        <p><strong>Phone:</strong> {{ htmlspecialchars($enquiry['phone']) }}</p>
    @endif

    @if (!empty($enquiry['enq_for']))
        <p><strong>Enquiry For:</strong> {{ htmlspecialchars($enquiry['enq_for']) }}</p>
    @endif

    @if (!empty($enquiry['state']))
        <p><strong>State:</strong> {{ htmlspecialchars($enquiry['state']) }}</p>
    @endif

    @if (!empty($enquiry['city']))
        <p><strong>City:</strong> {{ htmlspecialchars($enquiry['city']) }}</p>
    @endif

    @if (!empty($enquiry['message']))
        <p>
            <strong>Message:</strong><br>
            {!! nl2br(htmlspecialchars($enquiry['message'])) !!}
        </p>
    @endif

</body>

</html>