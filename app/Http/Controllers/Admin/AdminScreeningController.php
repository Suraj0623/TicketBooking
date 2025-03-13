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

        // Generate seat entries for the movie
        for ($i = 1; $i <= $request->total_seats; $i++) {
            $seatNumber = 'S' . $i; // Example seat numbering: S1, S2, S3...
            $screening->seats()->create([
                'seat_number' => $seatNumber,
                'status' => 'available',
            ]);
        }

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
        $screening = Screening::findOrFail($id);
        $movies = Movie::all();
        return view('admin.movies.screenings.edit', compact('screening', 'movies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'cinema' => 'required|string|max:255',
            'show_time' => 'required|date',
            'ticket_price' => 'required|numeric|min:0',
            'total_seats' => 'required|integer|min:1',
        ]);

        $screening = Screening::findOrFail($id);

        // Update the screening details
        $screening->update($request->only([
            'movie_id',
            'cinema',
            'show_time',
            'ticket_price',
            'total_seats',
        ]));
 // Update seats only if capacity changes
 if ($request->total_seats != $screening->seats()->count()) {
    $screening->seats()->delete(); // Remove existing seats
    for ($i = 1; $i <= $request->capacity; $i++) {
        $seatNumber = 'S' . $i;
        $screening->seats()->create([
            'seat_number' => $seatNumber,
            'status' => 'available',
        ]);
    }
}
        return redirect()->route('screenings.index')->with('success', 'Screening updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $screening = Screening::findOrFail($id);

        // Delete all associated seats
        $screening->seats()->delete();

        // Delete the screening
        $screening->delete();

        return redirect()->route('screenings.index')->with('success', 'Screening deleted successfully.');
    }
}