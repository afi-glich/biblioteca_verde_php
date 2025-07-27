<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Copy;

class ReservationController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            // L'admin vede tutte le prenotazioni con utente e copia
            $reservations = Reservation::with(['user', 'copy.book'])->paginate(20);
        } else {
            // L'utente normale vede solo le sue
            $reservations = Reservation::with('copy.book')
                ->where('user_id', auth()->id())
                ->get();
        }

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $users = User::all();
        $copies = Copy::with('book')->get();
        return view('reservations.create', compact('users', 'copies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'copy_id' => 'required|exists:copies,id',
        ]);

        $copy = Copy::findOrFail($request->copy_id);

        if ($copy->status !== 'disponibile') {
            return redirect()->back()->with('error', 'La copia non è disponibile.');
        }

        Reservation::create([
            'user_id' => auth()->id(),
            'copy_id' => $copy->id,
            'status' => 'in corso'
        ]);


        $copy->update(['status' => 'prenotato']);

        return redirect()->back()->with('success', 'Prenotazione effettuata con successo.');
    }
}
