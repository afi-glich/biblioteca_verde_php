<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


class BooksController extends Controller
{
    // show all books
    public function index()
    {
        $books = Book::with('category')->paginate(15);
        $categories = Category::all();
        return view('books.index', compact('books', 'categories'));
    }

    public function search(Request $request)
    {
        $books = Book::with('category', 'copies');

        if ($request->filled('query') && $request->filled('filter')) {
            $query = $request->input('query');
            $filter = $request->input('filter');

            $books->where($filter, 'like', "%{$query}%");
        }

        if ($request->filled('category')) {
            $books->where('category_id', $request->input('category'));
        }

        if ($request->filled('year')) {
            $books->where('publication_year', $request->input('year'));
        }

        if ($request->filled('availability') && $request->input('availability') === 'available') {
            $books->whereHas('copies', function ($q) {
                $q->where('status', 'disponibile');
            });
        }

        $books = $books->get();

        $categories = Category::all(); // Per il dropdown

        return view('books.index', compact('books', 'categories'));
    }


    

    public function show($id)
    {
        $book = Book::with('category')->findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validazione
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books,isbn',
            'description' => 'required|string',
            'publication_year' => 'required|string|max:4',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|max:2048', // max 2MB
        ]);


        $book = Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'isbn' => $validated['isbn'] ?? null,
            'publisher' => $validated['publisher'] ?? null,
            'publication_year' => $validated['publication_year'] ?? null,
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
        ]);

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $book->cover = $path;
            $book->save();
        }

        return redirect()->route('books.index')->with('success', 'Libro creato con successo!');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }


    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'description' => 'required|string',
            'publication_year' => 'required|string|max:4',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|max:2048',
        ]);

            
        $book->update([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'publisher' => $validated['publisher'],
            'description' => $validated['description'],
            'publication_year' => $validated['publication_year'],
            'category_id' => $validated['category_id'],
        ]);


        // Se c'è una nuova cover, elimina quella vecchia
        if ($request->hasFile('cover')) {
            // Elimina la vecchia se esiste
            if ($book->cover && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }

            // Salva la nuova
            $path = $request->file('cover')->store('covers', 'public');
            $book->cover = $path;
            $book->save();
        }
        return redirect()->route('books.index')->with('success', 'Libro aggiornato con successo!');
    }


    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Libro eliminato con successo!');
    }

}
