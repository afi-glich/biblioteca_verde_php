@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <form method="GET" action="{{ route('copies.index') }}" class="input-group mb-4">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cerca per titolo o barcode...">
        <button type="submit" class="btn btn-outline-primary">🔍</button>
    </form>

    <div class="mb-3">
        <a href="{{ route('copies.create') }}" class="btn btn-outline-success">➕ Aggiungi copia</a>
    </div>

    @if ($copies->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-success">
                    <tr>
                        <th>Titolo libro</th>
                        <th>Barcode</th>
                        <th>Stato</th>
                        <th>Posizione</th>
                        <th>Condizione</th>
                        <th>Note</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($copies as $copy)
                        <tr>
                            <td>{{ $copy->book->title }}</td>
                            <td>{{ $copy->barcode }}</td>
                            <td>{{ ucfirst($copy->status) }}</td>
                            <td>{{ $copy->location }}</td>
                            <td>{{ $copy->condition }}</td>
                            <td>{{ $copy->notes }}</td>
                            <td>
                                <a href="{{ route('copies.edit', $copy->id) }}" class="btn btn-sm btn-warning">✏️</a>
                                <form action="{{ route('copies.destroy', $copy->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Sei sicuro di voler eliminare questa copia?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $copies->withQueryString()->links() }}
    @else
        <div class="alert alert-info">Nessuna copia trovata.</div>
    @endif
</div>
@endsection
