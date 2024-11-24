<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $screenings = Screening::with('movie')->get();
        return view('admin.movies.screenings.index', compact('screenings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $movies = Movie::all();
        return view('admin.movies.screenings.create', compact('movies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'cinema' => 'required|string|max:255',
            'show_time' => 'required|date',
            'ticket_price' => 'required|numeric|min:0',
            'total_seats' => 'required|integer|min:1',
        ]);

        $screening = Screening::create($request->all());
       
        // Create seats for this screening
        $screening->seats()->create([
            'total_seats' => $request->total_seats,
            'available_seats' => $request->total_seats,
            'seatable_id' => $screening->id,
                'seatable_type' => Screening::class,
        ]);
                return redirect()->route('screenings.index')->with('success', 'Screening created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movies = Movie::all();
        return view('admin.movies.screenings.edit', compact('id', 'movies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'cinema' => 'required|string|max:255',
            'show_time' => 'required|date',
            'ticket_price' => 'required|numeric|min:0',
            'total_seats' => 'required|integer|min:1',
        ]);
        $screening=Movie::find($id);
        $screening->update($request->all());
        return redirect()->route('screenings.index')->with('success', 'Screening updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(  $id)
    {       
         $screening=Movie::find($id);

        $screening->delete();
        return redirect()->route('screenings.index')->with('success', 'Screening deleted successfully.');
    }
}
