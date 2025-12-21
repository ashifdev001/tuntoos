<!DOCTYPE html>
<html>

<head>
    <title>Enquiry Received</title>
</head>

<body>
    <h1>New Enquiry Received</h1>
    <p><strong>Name:</strong> {{ htmlspecialchars($enquiry['name']) }}</p>
    @if (!empty($enquiry['email']))
        <p><strong>Email:</strong> {{ htmlspecialchars($enquiry['email']) }}</p>
    @endif
    <p><strong>Phone:</strong> {{ htmlspecialchars($enquiry['phone']) }}</p>
    @if (!empty($enquiry['type']))
        <p><strong>Type:</strong> {{ nl2br(htmlspecialchars($enquiry['type'])) }}</p>
    @endif
    @if (!empty($enquiry['service']))
        <p><strong>Service:</strong> {{ nl2br(htmlspecialchars($enquiry['service'])) }}</p>
    @endif
    
    @if (!empty($enquiry['message']))
        <p><strong>Message:</strong> {{ nl2br(htmlspecialchars($enquiry['message'])) }}</p>
    @endif
</body>

</html>