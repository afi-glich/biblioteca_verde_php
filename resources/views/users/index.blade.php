@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="bg-white p-4 shadow-sm rounded">
        <table class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-success">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Data registrazione</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->is_admin)
                                <span class="badge bg-success">Sì</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Nessun utente trovato</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
