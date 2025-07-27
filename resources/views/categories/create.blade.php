@extends('layouts.app')

@section('title', 'Aggiungi Categoria')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-success">
        <div class="card-header bg-success text-white fw-bold">
            ➕ Aggiungi Nuova Categoria
        </div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome categoria</label>
                    <input type="text" name="name" class="form-control" required>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Salva</button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary ms-2">Annulla</a>
            </form>
        </div>
    </div>
</div>
@endsection
