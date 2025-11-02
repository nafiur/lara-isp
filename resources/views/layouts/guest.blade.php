<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            background: radial-gradient(circle at 20% 20%, rgba(13, 110, 253, 0.20), transparent 45%),
                        radial-gradient(circle at 80% 0%, rgba(13, 202, 240, 0.18), transparent 40%),
                        #0f172a;
            padding: 2rem;
            font-family: "Figtree", system-ui, sans-serif;
        }
        .auth-card {
            max-width: 480px;
            width: 100%;
            background: rgba(15, 23, 42, 0.86);
            color: #e2e8f0;
            border-radius: 1.5rem;
            box-shadow: 0 40px 80px rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(18px);
        }
        .brand-badge {
            background: rgba(59, 130, 246, 0.15);
            border: 1px solid rgba(59, 130, 246, 0.35);
            color: #60a5fa;
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }
        .form-control {
            background-color: rgba(15, 23, 42, 0.75);
            border-color: rgba(148, 163, 184, 0.3);
            color: #f8fafc;
        }
        .form-control:focus {
            background-color: rgba(15, 23, 42, 0.9);
            border-color: rgba(59, 130, 246, 0.6);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
            color: #f8fafc;
        }
        .form-check-input {
            border-color: rgba(148, 163, 184, 0.4);
        }
    </style>
</head>
<body>
    <div class="auth-card border-0">
        <div class="card-body p-5 p-lg-6">
            <div class="d-flex flex-column gap-3 mb-4 text-center">
                <span class="badge brand-badge align-self-center px-3 py-2 fw-semibold text-uppercase">
                    {{ __('Secure Access') }}
                </span>
                <a href="/" class="text-decoration-none text-reset">
                    <h1 class="h3 fw-semibold mb-0">{{ config('app.name', 'ISP Management System') }}</h1>
                </a>
                <p class="text-white-50 mb-0 small">
                    {{ __('Centralized operations for growing ISPs.') }}
                </p>
            </div>

            {{ $slot }}
        </div>
        <div class="card-footer border-0 bg-transparent text-center text-white-50 small py-3">
            &copy; {{ date('Y') }} {{ config('app.name') }} · {{ __('All rights reserved') }}
        </div>
    </div>
</body>
</html>
