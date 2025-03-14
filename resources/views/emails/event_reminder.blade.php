<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Reminder</title>
</head>
<body>
    <h1>Reminder: {{ $event->title }}</h1>
    <p>This is a reminder for the event happening on {{ $event->date }}.</p>
    <p>Description: {{ $event->description }}</p>
</body>
</html>
