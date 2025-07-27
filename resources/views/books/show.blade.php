@extends('layouts.app')

@section('title', 'Dettagli Libro')

@section('content')
<div class="container py-5">

    {{-- Successo/errore --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Dettagli libro --}}
    <div class="card shadow-sm border-success mb-4">
        <div class="card-header bg-success text-white fw-bold">
            📘 {{ $book->title }}
        </div>
        <div class="card-body row">
            <div class="col-md-4">
                <div style="width: 100%; height: 300px; overflow: hidden; background-color: #f8f9fa; border: 1px solid #ddd;">
                    @if($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="Copertina" class="cover-img">
                    @else
                        <p class="text-muted text-center pt-5">Nessuna copertina disponibile</p>
                    @endif
                </div>
</div>


            {{-- Colonna destra: dettagli libro --}}
            <div class="col-md-8">
                <h5 class="card-title">{{ $book->author }}</h5>
                <p class="card-text"><strong>Categoria:</strong> {{ $book->category->name ?? 'N/A' }}</p>
                <p class="card-text"><strong>ISBN:</strong> {{ $book->isbn }}</p>
                <p class="card-text"><strong>Editore:</strong> {{ $book->publisher }}</p>
                <p class="card-text"><strong>Anno:</strong> {{ $book->publication_year }}</p>
                <p class="card-text"><strong>Descrizione:</strong> {{ $book->description }}</p>

                <div class="mt-4 d-flex gap-2 flex-wrap">
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('books.edit', $book) }}" class="btn btn-outline-success btn-sm">✏️ Modifica libro</a>
                        @endif
                    @endauth

                    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary btn-sm">📚 Torna al catalogo</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabella copie --}}
    <div class="card shadow-sm border-success">
        <div class="card-header bg-success text-white fw-bold d-flex justify-content-between align-items-center">
            📦 Copie disponibili
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('copies.create', ['book_id' => $book->id]) }}" class="btn btn-outline-light btn-sm">➕ Aggiungi copia</a>
                @endif
            @endauth
        </div>
        <div class="card-body">
            @if($book->copies->count())
                <table class="table table-bordered table-hover bg-white">
                    <thead class="table-success">
                        <tr>
                            <th>Codice a barre</th>
                            <th>Stato</th>
                            <th>Posizione</th>
                            <th>Condizione</th>
                            @auth
                                @if(auth()->user()->is_admin)
                                    <th>Note</th>
                                @endif
                            @endauth
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($book->copies as $copy)
                            <tr>
                                <td>{{ $copy->barcode }}</td>
                                <td>{{ ucfirst($copy->status) }}</td>
                                <td>{{ $copy->location }}</td>
                                <td>{{ $copy->condition }}</td>
                                @auth
                                    @if(auth()->user()->is_admin)
                                        <td>{{ $copy->notes }}</td>
                                        <td>
                                            <a href="{{ route('copies.edit', $copy) }}" class="btn btn-sm btn-outline-warning">✏️ Modifica</a>
                                            <form action="{{ route('copies.destroy', $copy) }}" method="POST" class="d-inline" onsubmit="return confirm('Sei sicuro di voler eliminare questa copia?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">🗑️ Elimina</button>
                                            </form>
                                        </td>
                                    @else
                                        <td>
                                            @if($copy->status === 'disponibile')
                                                <form method="POST" action="{{ route('reservations.store') }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="copy_id" value="{{ $copy->id }}">
                                                    <button type="submit" class="btn btn-sm btn-outline-success">📅 Prenota</button>
                                                </form>

                                            @else
                                                <span class="text-muted">Non disponibile</span>
                                            @endif
                                        </td>
                                    @endif
                                @endauth
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">Nessuna copia associata a questo libro.</p>
            @endif
        </div>
    </div>
</div>
@endsection
