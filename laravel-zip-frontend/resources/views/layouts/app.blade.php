<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title") - City & County Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: none;
            margin-bottom: 1.5rem;
        }
        .btn-group-action {
            display: flex;
            gap: 0.5rem;
        }
        .main-container {
            padding: 2rem 0;
        }
    </style>
    @yield("styles")
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/"> City & County Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs("dashboard") ? "active" : "" }}" href="{{ route("dashboard") }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs("cities.*") ? "active" : "" }}" href="{{ route("cities.index") }}">Cities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs("counties.*") ? "active" : "" }}" href="{{ route("counties.index") }}">Counties</a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link text-muted">{{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route("logout") }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs("login") ? "active" : "" }}" href="{{ route("login") }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs("register") ? "active" : "" }}" href="{{ route("register") }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-container">
        <div class="container">
            @if ($message = session("success"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($message = session("error"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield("content")
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p>&copy; 2026 City & County Manager. Built with Laravel & Bootstrap.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield("scripts")
</body>
</html>
