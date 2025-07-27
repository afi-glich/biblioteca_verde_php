<!DOCTYPE html>
<html>
<head>
    <title>Nuova Prenotazione</title>
</head>
<body>
    <h1>Crea Prenotazione</h1>

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf

        <label>Utente:</label>
        <select name="user_id">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select><br><br>

        <label>Copia:</label>
        <select name="copy_id">
            @foreach($copies as $copy)
                <option value="{{ $copy->id }}">{{ $copy->barcode }} - {{ $copy->book->title ?? 'N/A' }}</option>
            @endforeach
        </select><br><br>

        <label>Status:</label>
        <select name="status">
            <option value="pending">Pending</option>
            <option value="confirmed">Confirmed</option>
            <option value="cancelled">Cancelled</option>
            <option value="completed">Completed</option>
        </select><br><br>

        <label>Data Prenotazione:</label>
        <input type="date" name="reserved_at"><br><br>

        <label>Data Scadenza:</label>
        <input type="date" name="due_date"><br><br>

        <button type="submit">Salva</button>
    </form>
</body>
</html>
