<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Reminder App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
        }
    </style>
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('events.index') }}">Event Reminder</a>
    
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.index') }}">All Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.upcoming') }}">Upcoming Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.completed') }}">Completed Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.create') }}">Create Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-info text-light" href="{{ route('events.import') }}">📥 Import Events</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <div class="container main-content py-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <div class="container">
            <p>&copy; {{ date('Y') }} Event Reminder App. All rights reserved.</p>
            <p>Contact us: arshuvo2021@gmail.com</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
