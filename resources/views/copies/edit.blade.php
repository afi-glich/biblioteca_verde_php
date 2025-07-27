@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-success">✏️ Modifica Copia</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('copies.update', $copy) }}" method="POST" class="bg-white p-4 shadow-sm rounded">
        @csrf
        @method('PUT')

        <!-- Libro (non modificabile) -->
        <div class="mb-3">
            <label class="form-label">📚 Titolo libro</label>
            <input type="text" class="form-control" value="{{ $copy->book->title }}" disabled>
        </div>

        <!-- Barcode (non modificabile) -->
        <div class="mb-3">
            <label class="form-label">🔖 Barcode</label>
            <input type="text" class="form-control" value="{{ $copy->barcode }}" disabled>
        </div>

        <!-- Stato -->
        <div class="mb-3">
            <label for="status" class="form-label">📦 Stato</label>
            <select name="status" id="status" class="form-select" required>
                <option disabled {{ old('status', $copy->status) ? '' : 'selected' }}>-- Seleziona stato --</option>
                <option value="disponibile" {{ old('status', $copy->status) == 'disponibile' ? 'selected' : '' }}>Disponibile</option>
                <option value="non disponibile" {{ old('status', $copy->status) == 'non disponibile' ? 'selected' : '' }}>Non disponibile</option>
            </select>
        </div>


        <!-- Posizione -->
        <div class="mb-3">
            <label for="location" class="form-label">📍 Posizione</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $copy->location) }}" required>
        </div>

        <!-- Condizione -->
        <div class="mb-3">
            <label for="condition" class="form-label">📝 Condizione</label>
            <select name="condition" id="condition" class="form-select" required>
                <option value="Ottimo" {{ old('condition', $copy->condition) == 'Ottimo' ? 'selected' : '' }}>Ottimo</option>
                <option value="Buono" {{ old('condition', $copy->condition) == 'Buono' ? 'selected' : '' }}>Buono</option>
                <option value="Discreto" {{ old('condition', $copy->condition) == 'Discreto' ? 'selected' : '' }}>Discreto</option>
            </select>
        </div>

        <!-- Note -->
        <div class="mb-3">
            <label for="notes" class="form-label">🗒️ Note</label>
            <textarea name="notes" id="notes" rows="3" class="form-control">{{ old('notes', $copy->notes) }}</textarea>
        </div>

        <div>
            <button type="submit" class="btn btn-success">Aggiorna Copia</button>
            <a href="{{ route('copies.index') }}" class="btn btn-outline-secondary ms-2">Annulla</a>
        </div>
    </form>
</div>
@endsection
