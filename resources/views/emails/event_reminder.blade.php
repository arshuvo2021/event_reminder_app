<!DOCTYPE html>
<html>
<head>
    <title>Event Reminder</title>
</head>
<body>
    <h1>Reminder for Event: {{ $event->title }}</h1>
    <p>This is a reminder that the event "{{ $event->title }}" will take place on {{ $event->date }}.</p>
    <p>We hope to see you there!</p>
    <p>Reminder set for: {{ $reminderTime }}</p>
</body>
</html>
