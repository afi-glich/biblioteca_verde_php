@extends('layouts.app')

@section('title', 'Modifica Categoria')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-success">
        <div class="card-header bg-success text-white fw-bold">
            ✏️ Modifica Categoria
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nome categoria</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Aggiorna</button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary ms-2">Annulla</a>
            </form>
        </div>
    </div>
</div>
@endsection
