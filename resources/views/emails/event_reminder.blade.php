<!DOCTYPE html>
<html>
<head>
    <title>Event Reminder</title>
</head>
<body>
    <h2>Reminder: Your Event is Tomorrow!</h2>
    <p><strong>Event:</strong> {{ $event->title }}</p>
    <p><strong>Date:</strong> {{ $event->date }}</p>
    <p><strong>Description:</strong> {{ $event->description ?? 'No description provided' }}</p>
    <p>Don't forget to attend!</p>
</body>
</html>
