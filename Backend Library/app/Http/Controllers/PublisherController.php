<?php
namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the publishers.
     */
    public function index()
    {
        $publishers = Publisher::all();
        return response()->json($publishers, 200);
    }

    /**
     * Store a newly created publisher.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $publisher = Publisher::create($request->all());
        return response()->json($publisher, 201);
    }

    /**
     * Display the specified publisher.
     */
    public function show($id)
    {
        $publisher = Publisher::findOrFail($id);
        return response()->json($publisher, 200);
    }

    /**
     * Update the specified publisher.
     */
    public function update(Request $request, $id)
    {
        $publisher = Publisher::findOrFail($id);
        
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
        ]);

        $publisher->update($request->all());
        return response()->json($publisher, 200);
    }

    /**
     * Remove the specified publisher.
     */
    public function destroy($id)
    {
        Publisher::destroy($id);
        return response()->json(null, 204);
    }
}