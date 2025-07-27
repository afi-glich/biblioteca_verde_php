<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Digitale</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4fdf6;
            font-family: 'Segoe UI', sans-serif;
        }
        .hero {
            padding: 100px 20px;
            background: linear-gradient(to right, #a8e6cf, #dcedc1);
            border-radius: 15px;
        }
        .btn-custom {
            background-color: #4CAF50;
            color: white;
        }
        .btn-custom-outline {
            border: 2px solid #4CAF50;
            color: #4CAF50;
        }
        .btn-custom-outline:hover {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

    <div class="container text-center hero mt-5">
        <h1 class="display-4 mb-4">📚 Biblioteca Verde</h1>
        <p class="lead mb-4">Gestisci, prenota e consulta i libri della nostra biblioteca comodamente online.</p>


        @auth
            <!-- Solo per utenti loggati -->
            <div>
                <a href="{{ url('/dashboard') }}" class="me-3 text-success fw-semibold">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link text-danger p-0 m-0 align-baseline">Esci</button>
                </form>
            </div>
        @else
            <!-- Per utenti non loggati -->
            <div class="mt-4">
                <a href="{{ route('login') }}" class="btn btn-outline-success me-2">Accedi</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary">Registrati</a>
                @endif
            </div>
        @endauth
    </div>

</body>
</html>
