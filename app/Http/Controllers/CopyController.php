<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Copy;
use App\Models\Book;

class CopyController extends Controller
{
    public function index()
    {
        $copies = Copy::with('book')->paginate(20);
        return view('copies.index', compact('copies'));
    }

    public function search(Request $request)
    {
        $query = Copy::with('book');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('book', function ($q) use ($search) {
                $q->where('title', 'like', "%$search%");
            })->orWhere('barcode', 'like', "%$search%");
        }

        $copies = $query->paginate(20);

        return view('copies.index', compact('copies'));
    }

    public function create()
    {
        return view('copies.create');
    }

   public function store(Request $request)
    {
        $validated = $request->validate([
            'book_title' => 'required|string|max:255',
            'status' => 'required|in:disponibile,prenotato,non disponibile',
            'location' => 'required|string|max:255',
            'condition' => 'required|in:ottimo,buono,discreto',
            'notes' => 'nullable|string',
        ]);

        // Cerca il libro per titolo
        $book = Book::where('title', $validated['book_title'])->first();

        if (!$book) {
            return back()->withErrors(['book_title' => 'Libro non trovato. Assicurati che il titolo sia corretto.'])->withInput();
        }

        // Genera barcode unico
        do {
            $barcode = 'BC-' . strtoupper(bin2hex(random_bytes(5)));
        } while (Copy::where('barcode', $barcode)->exists());

        // Crea la copia
        Copy::create([
            'book_id' => $book->id,
            'status' => $validated['status'],
            'location' => $validated['location'],
            'condition' => $validated['condition'],
            'notes' => $validated['notes'] ?? null,
            'barcode' => $barcode,
        ]);

        return redirect()->route('copies.index')->with('success', 'Copia aggiunta con successo!');
    }


    public function edit(Copy $copy)
    {
        $books = Book::all();
        return view('copies.edit', compact('copy', 'books'));
    }

    public function update(Request $request, Copy $copy)
    {
        $validated = $request->validate([
            'status' => 'required|string',
            'location' => 'required|string',
            'status' => 'required|in:disponibile,prenotato,non disponibile',
            'condition' => 'required|in:ottimo,buono,discreto',
            'notes' => 'nullable|string',
        ]);

        $copy->update($validated);

        return redirect()->route('copies.index')->with('success', 'Copia aggiornata con successo!');
    }

    public function destroy(Copy $copy)
    {
        $copy->delete();
        return redirect()->route('copies.index');
    }

}
