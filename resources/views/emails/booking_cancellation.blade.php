<!DOCTYPE html>
<html>
<head>
    <title>Booking Cancellation</title>
</head>
<body>
<h1>Booking Cancellation</h1>
<p>Dear {{ $booking->user_name }},</p>
<p>Your booking for {{ $booking->activity->name }} has been cancelled.</p>
<p>If you have any questions or need further assistance, please contact us.</p>
</body>
</html>
