@extends('layouts.app')

@section('title', 'Gestione Prenotazioni')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-success">
        <div class="card-header bg-success text-white fw-bold">
            Le tue prenotazioni
        </div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($reservations->count())
                <table class="table table-hover table-bordered bg-white shadow-sm">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            @if(auth()->user()->is_admin)
                                <th>Utente</th>
                            @endif
                            <th>Titolo Libro</th>
                            <th>Autore</th>
                            <th>Barcode Copia</th>
                            <th>Data Prenotazione</th>
                            <th>Stato</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->id }}</td>
                                @if(auth()->user()->is_admin)
                                    <td>{{ $reservation->user->name }}</td>
                                @endif
                                <td>{{ $reservation->copy->book->title }}</td>
                                <td>{{ $reservation->copy->book->author }}</td>
                                <td>{{ $reservation->copy->barcode }}</td>
                                <td>{{ $reservation->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @if($reservation->status === 'in corso')
                                        <span class="badge bg-warning text-dark">Attiva</span>
                                    @elseif($reservation->status === 'restituito')
                                        <span class="badge bg-success">Restituita</span>
                                    @endif
                                </td>
                                <td>
                                    @if($reservation->status === 'attiva')
                                        <form action="{{ route('reservations.return', $reservation) }}" method="POST" class="d-inline" onsubmit="return confirm('Confermi la restituzione del libro?');">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-sm btn-outline-primary">📤 Restituisci</button>
                                        </form>
                                    @else
                                        <span class="text-muted">Nessuna azione</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">Nessuna prenotazione trovata.</p>
            @endif

        </div>
    </div>
</div>
@endsection
