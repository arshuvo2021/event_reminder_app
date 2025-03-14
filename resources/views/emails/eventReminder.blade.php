<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .button {
            background: #28a745;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: gray;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            📅 Event Reminder
        </div>
        <div class="content">
            <h2>{{ $eventTitle }}</h2>
            <p><strong>Date:</strong> {{ $eventDate }}</p>
            <p><strong>Time:</strong> {{ $eventTime }}</p>
            <p><strong>Description:</strong> {{ $eventDescription }}</p>
            <p><strong>Reminder Time:</strong> {{ $reminderTime }}</p>

            <a href="{{ route('events.show', $event->id) }}" class="button">View Event</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Event Reminder App</p>
        </div>
    </div>
</body>
</html>
