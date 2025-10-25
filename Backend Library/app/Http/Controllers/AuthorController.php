<?php
namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the authors.
     */
    public function index()
    {
        $authors = Author::all();
        return response()->json($authors, 200);
    }

    /**
     * Store a newly created author.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::create($request->all());
        return response()->json($author, 201);
    }

    /**
     * Display the specified author.
     */
    public function show($id)
    {
        $author = Author::findOrFail($id);
        return response()->json($author, 200);
    }

    /**
     * Update the specified author.
     */
    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);
        
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
        ]);

        $author->update($request->all());
        return response()->json($author, 200);
    }

    /**
     * Remove the specified author.
     */
    public function destroy($id)
    {
        Author::destroy($id);
        return response()->json(null, 204);
    }
}