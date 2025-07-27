@extends('layouts.app')

@section('title', 'Catalogo Libri')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-success">📚 Catalogo Libri</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('books.search') }}" method="GET" class="mb-4">
        {{-- 🔍 Barra di ricerca in alto --}}
        <div class="row g-2 mb-2">
            <div class="col-md-6">
                <input type="text" name="query" class="form-control" placeholder="Cerca..." value="{{ request('query') }}">
            </div>

            <div class="col-md-4">
                <select name="filter" class="form-select">
                    <option value="title" {{ request('filter') == 'title' ? 'selected' : '' }}>Titolo</option>
                    <option value="author" {{ request('filter') == 'author' ? 'selected' : '' }}>Autore</option>
                    <option value="isbn" {{ request('filter') == 'isbn' ? 'selected' : '' }}>ISBN</option>
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-success w-100">🔍 Cerca</button>
            </div>
        </div>

        {{-- 🎯 Filtri aggiuntivi sotto --}}
        <div class="row g-2">
            <div class="col-md-4">
                <select name="category" class="form-select">
                    <option value="">Tutte le categorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <select name="availability" class="form-select">
                    <option value="">Tutti i libri</option>
                    <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>
                        Solo disponibili
                    </option>
                </select>
            </div>

            <div class="col-md-4">
                <input type="number" name="year" class="form-control" placeholder="Anno di pubblicazione" value="{{ request('year') }}">
            </div>
        </div>
    </form>


    {{-- Azioni admin --}}
    @auth
        @if(auth()->user()->is_admin)
            <div class="mb-4 d-flex gap-2">
                <a href="{{ route('books.create') }}" class="btn btn-success">➕ Aggiungi Libro</a>
            </div>
        @endif
    @endauth

    @if($books->count())
        <table class="table table-hover table-bordered bg-white shadow-sm">
            <thead class="table-success">
                <tr>
                    <th>Titolo</th>
                    <th>Autore</th>
                    <th>ISBN</th>
                    <th>Categoria</th>
                    <th>Editore</th>
                    <th>Anno</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>{{ $book->category ? $book->category->name : '-' }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->publication_year }}</td>
                        <td>
                            <a href="{{ route('books.show', $book) }}" class="btn btn-outline-success btn-sm">Dettagli</a>
                            @auth
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('books.edit', $book) }}" class="btn btn-outline-warning btn-sm">Modifica</a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline" onsubmit="return confirm('Sei sicuro di voler eliminare questo libro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Elimina</button>
                                    </form>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">Nessun libro trovato.</p>
    @endif
</div>
@endsection
