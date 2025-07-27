@extends('layouts.guest')

@section('title', 'Accedi')

@section('content')
<div class="auth-card">
    <h2 class="text-center auth-title mb-4">Accedi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required autofocus value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required autocomplete="current-password">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="remember" id="remember">
            <label class="form-check-label" for="remember">Ricordami</label>
        </div>

        <button type="submit" class="btn btn-custom w-100">Accedi</button>

        <div class="mt-3 text-center">
            <a href="{{ route('register') }}">Non hai un account? Registrati</a>
        </div>
    </form>
</div>
@endsection
