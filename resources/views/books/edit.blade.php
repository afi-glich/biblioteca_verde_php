@extends('layouts.app')


@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Attenzione!</strong> Ci sono alcuni errori nei dati inseriti:<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')

    <div class="container mt-5">
        <div class="card shadow rounded-4">
            <div class="card-header bg-success text-white rounded-top-4">
                <h4 class="mb-0">Modifica libro</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="cover" class="form-label">Carica copertina</label>
                        <input type="file" class="form-control" name="cover" id="cover" accept="image/*">
                    </div>

                    <!-- Titolo -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
                    </div>

                    <!-- Autore -->
                    <div class="mb-3">
                        <label for="author" class="form-label">Autore</label>
                        <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="publisher" class="form-label">Editore</label>
                        <input type="text" name="publisher" value="{{ $book->publisher }}" class="form-control" required>
                    </div>

                    <!-- ISBN (non modificabile) -->
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" name="isbn" value="{{ $book->isbn }}" class="form-control" disabled>
                    </div>

                    <!-- Anno di pubblicazione -->
                    <div class="mb-3">
                        <label for="publication_year" class="form-label">Anno di pubblicazione</label>
                        <input type="text" name="publication_year" class="form-control" value="{{ old('publication_year', $book->publication_year) }}" required>
                    </div>

                    <!-- Descrizione -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea name="description" class="form-control" rows="5" required>{{ old('description', $book->description) }}</textarea>
                    </div>


                    <!-- Categoria -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Categoria</label>
                        <select name="category_id" class="form-select" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pulsanti -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">Annulla</a>
                        <button type="submit" class="btn btn-outline-success">Salva modifiche</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
