<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all();
        return view('admin.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data (excluding 'poster')
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'poster_url'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genre' => 'nullable|string',
            'director' => 'nullable|string',
        ]);

        // Handle file upload (if a file is provided)
        if ($request->hasFile('poster_url')) {
            $path = $request->file('poster_url')->store('movies', 'public'); // Store the file in the 'storage/app/public/posters' directory
            $validated['poster_url'] = $path; // Add the file path to the validated data
        }

        // Create the movie record
        Movie::create($validated);

        return redirect()->route('movies.index')->with('success', 'Movie added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::with('screenings')->findOrFail($id);
        return view('admin.movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    // Validate the incoming request data (excluding 'poster')
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'release_date' => 'nullable|date',
        'poster_url'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'genre' => 'nullable|string',
        'director' => 'nullable|string',
    ]);

    // Find the movie to update
    $movie = Movie::findOrFail($id);

     // Handle file upload (if a new file is provided)
     if ($request->hasFile('poster_url')) {
        // Delete old image if exists
        if ($movie->poster_url) {
            Storage::disk('public')->delete($movie->poster_url);
        }
        $path = $request->file('poster_url')->store('movies', 'public');
        $validated['poster_url'] = $path;
    }

    // Update the movie record with the validated data (including poster_url if it's updated)
    $movie->update($validated);

    return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        // Delete the poster file if it exists
        if ($movie->poster_url) {
            Storage::disk('public')->delete($movie->poster_url);
        }

        // Delete the movie record
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}