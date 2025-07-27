<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca - @yield('title', 'Accesso')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4fdf6;
            font-family: 'Segoe UI', sans-serif;
        }
        .auth-card {
            max-width: 400px;
            margin: 100px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .auth-title {
            color: #4CAF50;
        }
        .btn-custom {
            background-color: #4CAF50;
            color: white;
        }
        .btn-custom:hover {
            background-color: #45a049;
        }
        .navbar-custom {
            background-color: #ffffff;
            border-bottom: 1px solid #dcedc1;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
        <div class="container px-4">
            <a class="navbar-brand text-success fw-bold" href="{{ url('/') }}">📚 Biblioteca</a>
        </div>
    </nav>

    <!-- Auth Content -->
    <main>
        @yield('content')
    </main>

</body>
</html>
