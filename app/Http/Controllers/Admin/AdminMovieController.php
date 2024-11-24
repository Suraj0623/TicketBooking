<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seat;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies=Movie::all();
        return view('admin.movies.index',compact('movies'));
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
        $validated=$request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'poster'=>'nullable|image',
            'genre' => 'nullable|string',
            'director' => 'nullable|string',
        ]);
        if($request->hasFile('poster')){
            $validated['poster_url']=$request->file('psoter')->store('storage','public');
        }

       $movie= Movie::create($validated);
    //     $movie->seats()->create([
    //     'total_seats'=>$request->total_seats,
    //     'available_seats'=>$request->total_seats,
    //     'seatable_id' => $movie->id,
    //     'seatable_type' => Movie::class,
    //    ]);
        return redirect()->route('movies.index')->with('success', 'Movie added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie=Movie::with('screenings')->findOrFail($id);
        return view('admin.movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.movies.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'genre' => 'nullable|string',
            'director' => 'nullable|string',
        ]);
        $movie=Movie::find($id);
        $movie->update($request->all());
        return redirect()->route('movie.index')->with('success', 'Movie updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    { 
        $movie=Movie::find($id);
        $movie->delete();
        return redirect()->route('movie.index')->with('success', 'Movie deleted successfully.');

    }
}
