<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca</title>

    <!-- Google Fonts e Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(145deg, #e0f7ea, #b9f6ca);
            min-height: 100vh;
            margin: 0;
        }

        .top-bar {
            background-color: #ffffff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .top-bar .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2e7d32;
        }

        .top-bar .nav-links a {
            margin-left: 20px;
            text-decoration: none;
            color: #2e7d32;
            font-weight: 600;
        }

        .top-bar .nav-links a:hover {
            color: #1b5e20;
        }

        .container {
            padding-top: 30px;
        }

        .btn-primary {
            background-color: #43a047;
            border-color: #43a047;
        }

        .btn-primary:hover {
            background-color: #388e3c;
            border-color: #388e3c;
        }

        footer {
            background-color: #2e7d32;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<header class="top-bar d-flex justify-content-between align-items-center p-3 shadow-sm">
    <div class="logo text-success fs-4 fw-bold">
        Biblioteca Verde
    </div>

    <nav>
        @auth
            @if(auth()->user()->is_admin)
                <a href="{{ route('books.index') }}" class="btn btn-outline-success btn-sm me-2">📚 Gestisci catalogo</a>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-success btn-sm me-2">🗂️ Gestisci categorie</a>
                <a href="{{ route('copies.index') }}" class="btn btn-outline-success btn-sm me-2">🗂️ Gestisci copie</a>
                <a href="{{ route('users.index') }}" class="btn btn-outline-success btn-sm me-2">🗂️ Gestisci utenti</a>
                <a href="{{ route('reservations.index') }}" class="btn btn-outline-success btn-sm me-2">📅 Gestisci prenotazioni</a>
            @else
                <a href="{{ route('books.index') }}" class="btn btn-outline-success btn-sm me-2">📚 Catalogo</a>
                <a href="{{ route('reservations.index') }}" class="btn btn-outline-success btn-sm me-2">📅 Le tue prenotazioni</a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">Esci</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm me-2">Accedi</a>
            <a href="{{ route('register') }}" class="btn btn-outline-success btn-sm">Registrati</a>
        @endauth
    </nav>
</header>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <p>© {{ date('Y') }} Biblioteca Verde. Tutti i diritti riservati.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
