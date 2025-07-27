@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded-4 p-4">
        <h3 class="mb-4">➕ Aggiungi nuova copia</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Attenzione!</strong> Ci sono problemi con i dati inseriti:
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('copies.store') }}" method="POST">
            @csrf

            <!-- Titolo del libro -->
            <div class="mb-3">
                <label for="book_title" class="form-label">📘 Titolo del libro <span class="text-danger">*</span></label>
                <input type="text" name="book_title" id="book_title" class="form-control" placeholder="Es. Il nome della rosa" value="{{ old('book_title') }}" required>
            </div>

            <!-- Stato -->
            <div class="mb-3">
                <label for="status" class="form-label">📌 Stato <span class="text-danger">*</span></label>
                <select name="status" id="status" class="form-select" required>
                    <option disabled selected>-- Seleziona stato --</option>
                    <option value="disponibile" {{ old('status') == 'disponibile' ? 'selected' : '' }}>Disponibile</option>
                    <option value="prenotato" {{ old('status') == 'prenotato' ? 'selected' : '' }}>Prenotato</option>
                    <option value="non disponibile" {{ old('status') == 'non disponibile' ? 'selected' : '' }}>Non disponibile</option>
                </select>
            </div>

            <!-- Posizione -->
            <div class="mb-3">
                <label for="location" class="form-label">📍 Posizione <span class="text-danger">*</span></label>
                <input type="text" name="location" id="location" class="form-control" placeholder="Es. Scaffale B2" value="{{ old('location') }}" required>
            </div>

            <!-- Condizione -->
            <div class="mb-3">
                <label for="condition" class="form-label">📝 Condizione <span class="text-danger">*</span></label>
                <select name="condition" id="condition" class="form-select" required>
                    <option disabled selected>-- Seleziona condizione --</option>
                    <option value="Buono" {{ old('condition') == 'Buono' ? 'selected' : '' }}>Buono</option>
                    <option value="Ottimo" {{ old('condition') == 'Ottimo' ? 'selected' : '' }}>Ottimo</option>
                    <option value="Discreto" {{ old('condition') == 'Discreto' ? 'selected' : '' }}>Discreto</option>
                </select>
            </div>


            <!-- Note -->
            <div class="mb-3">
                <label for="notes" class="form-label">🗒️ Note (facoltative)</label>
                <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Eventuali annotazioni">{{ old('notes') }}</textarea>
            </div>

            <!-- Azioni -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('copies.index') }}" class="btn btn-secondary">
                    ⬅️ Indietro
                </a>
                <button type="submit" class="btn btn-success">
                    💾 Salva copia
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
