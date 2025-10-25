<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index()
    {
        $books = Book::with(['author', 'publisher'])->get();
        return response()->json($books, 200);
    }

    /**
     * Store a newly created book.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'publisher_id' => 'required|exists:publishers,id',
        ]);

        $book = Book::create($request->all());
        return response()->json($book->load(['author', 'publisher']), 201);
    }

    /**
     * Display the specified book.
     */
    public function show($id)
    {
        $book = Book::with(['author', 'publisher'])->findOrFail($id);
        return response()->json($book, 200);
    }

    /**
     * Update the specified book.
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author_id' => 'sometimes|required|exists:authors,id',
            'publisher_id' => 'sometimes|required|exists:publishers,id',
        ]);

        $book->update($request->all());
        return response()->json($book->load(['author', 'publisher']), 200);
    }

    /**
     * Remove the specified book.
     */
    public function destroy($id)
    {
        Book::destroy($id);
        return response()->json(null, 204);
    }
}