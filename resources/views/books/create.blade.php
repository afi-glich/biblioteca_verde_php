@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded-4">
        <div class="card-header bg-success text-white rounded-top-4">
            <h3 class="mb-0">📘 Aggiungi un nuovo libro</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <strong>Errore!</strong> Correggi i seguenti problemi:<br><br>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>🔴 {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="cover" class="form-label">Carica copertina</label>
                    <input type="file" class="form-control" name="cover" id="cover" accept="image/*">
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Autore</label>
                    <input type="text" name="author" class="form-control" value="{{ old('author') }}" required>
                </div>

                <div class="mb-3">
                    <label for="publisher" class="form-label">Editore</label>
                    <input type="text" name="publisher" class="form-control" value="{{ old('publisher') }}" required>
                </div>

                <div class="mb-3">
                    <label for="publisher" class="form-label">Anno di pubblicazione</label>
                    <input type="text" name="publication_year" class="form-control" value="{{ old('publication_year') }}" required>
                </div>

                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}" required>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Categoria</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Seleziona una categoria --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea name="description" rows="4" class="form-control" required>{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-success me-2">💾 Salva libro</button>
                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">↩️ Annulla</a>
            </form>
        </div>
    </div>
</div>
@endsection
