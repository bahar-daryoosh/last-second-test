<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
<h1>Booking Confirmation</h1>
<p>Dear {{ $booking->user_name }},</p>
<p>Thank you for booking with us. Your booking details are as follows:</p>
<ul>
    <li>Activity: {{ $booking->activity->name }}</li>
    <li>Date: {{ $booking->activity->start_date->format('Y-m-d H:i') }}</li>
    <li>Slots Booked: {{ $booking->slots_booked }}</li>
</ul>
<p>We look forward to seeing you!</p>
</body>
</html>
