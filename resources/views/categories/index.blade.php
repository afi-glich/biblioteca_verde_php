@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <form action="{{ route('categories.search') }}" method="GET" class="row g-2 mb-4">
        <div class="col-md-10">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="🔍 Cerca per nome categoria">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-success w-100">Cerca</button>
        </div>
    </form>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @auth
        @if(auth()->user()->is_admin)
            <div class="mb-4">
                <a href="{{ route('categories.create') }}" class="btn btn-success">
                    ➕ Aggiungi Categoria
                </a>
            </div>
        @endif
    @endauth

    @if($categories->count())
        <table class="table table-hover table-bordered bg-white shadow-sm">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    @auth
                        @if(auth()->user()->is_admin)
                            <th>Azioni</th>
                        @endif
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        @auth
                            @if(auth()->user()->is_admin)
                                <td>
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-warning me-2">✏️ Modifica</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Sei sicuro di voler eliminare questa categoria?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">🗑️ Elimina</button>
                                    </form>
                                </td>
                            @endif
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">Nessuna categoria trovata.</p>
    @endif
</div>
@endsection
