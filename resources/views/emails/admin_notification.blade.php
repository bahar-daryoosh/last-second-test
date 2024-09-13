<!DOCTYPE html>
<html>
<head>
    <title>New Booking Notification</title>
</head>
<body>
<h1>New Booking Notification</h1>
<p>A new booking has been made with the following details:</p>
<ul>
    <li>Activity: {{ $booking->activity->name }}</li>
    <li>User: {{ $booking->user_name }}</li>
    <li>Slots Booked: {{ $booking->slots_booked }}</li>
</ul>
</body>
</html>
