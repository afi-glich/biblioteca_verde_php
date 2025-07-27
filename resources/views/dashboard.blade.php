@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-success">
        <div class="card-header bg-success text-white fw-bold">
            Benvenuto nella tua area personale
        </div>
        <div class="card-body">
            <p class="card-text">Ciao <strong>{{ Auth::user()->name }}</strong>, sei autenticato nel sistema della Biblioteca.</p>
            (e no, non è verde perché attenta all'ambiente ma perché il sito è verde)
        </div>
    </div>
</div>
@endsection
