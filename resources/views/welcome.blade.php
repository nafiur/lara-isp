<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'ISP Management System') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 20% 20%, rgba(13,110,253,0.15), transparent 40%),
                        radial-gradient(circle at 80% 0%, rgba(13,202,240,0.2), transparent 45%),
                        #0f172a;
            color: #f8fafc;
            font-family: "Figtree", system-ui, sans-serif;
        }
        .card {
            max-width: 640px;
            width: 100%;
            background: rgba(15, 23, 42, 0.85);
            border-radius: 1.25rem;
            box-shadow: 0 40px 80px rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(18px);
        }
    </style>
</head>
<body>
    <div class="card border-0">
        <div class="card-body p-5 p-md-6">
            <span class="badge bg-primary-subtle text-primary fw-semibold mb-3">
                ISP Management Platform
            </span>
            <h1 class="display-6 fw-semibold lh-sm mb-3">{{ config('app.name', 'ISP Management System') }}</h1>
            <p class="lead text-white-50 mb-4">
                Manage subscribers, automate billing, and keep your network in sync from a single command center.
            </p>
            <div class="d-flex flex-wrap gap-3">
                @auth
                    <a class="btn btn-primary btn-lg px-4" href="{{ url('/dashboard') }}">
                        <i class="fas fa-gauge-high me-2"></i>Go to Dashboard
                    </a>
                @else
                    <a class="btn btn-primary btn-lg px-4" href="{{ route('login') }}">
                        <i class="fas fa-right-to-bracket me-2"></i>Sign in
                    </a>
                    @if (Route::has('register'))
                        <a class="btn btn-outline-light btn-lg px-4" href="{{ route('register') }}">
                            Create account
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</body>
</html>
