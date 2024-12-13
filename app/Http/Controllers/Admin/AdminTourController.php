<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seat;
use App\Models\Tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::all();
        return view('admin.tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tours.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validate the request
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Added image validation
        'packageName' => 'required',
        'ticket_price' => 'required|numeric',
        'duration' => 'required',
        'highlights' => 'required',
        'avg_rating' => 'required|numeric',
        'total_rating' => 'required|numeric'
    ]);

    // Store the image and get the file path
    $path = $request->file('image')->store('storage/tours', 'public');

    // Create the new tour and save the image path
    $tour=Tour::create([
        'name' => $request->name,
        'description' => $request->description,
        'image' => $path,  // Store the image path in the database
        'packageName' => $request->packageName,
        'ticket_price' => $request->price,
        'duration' => $request->duration,
        'highlights' => $request->highlights,
        'avg_rating' => $request->avg_rating,
        'total_rating' => $request->total_rating
    ]);
    Seat::create([
        'seatable_id' => $tour->id,
        'seatable_type' => Tour::class,
        'total_seats' => 100,
        'available_seats' => 100,
    ]);

    // Redirect back to the tour index page
    return redirect()->route('tours.index');
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
        $tour = Tour::findOrFail($id);
        return view('admin.tours.edit', compact('tour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'packageName' => 'required',
            'ticket_price' => 'required|numeric',
            'duration' => 'required',
            'highlights' => 'required',
            'avg_rating' => 'required|numeric',
            'total_rating' => 'required|numeric'
        ]);

        $tour = Tour::findOrFail($id);
        $tour->update($request->all());

        return redirect()->route('tours.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();

        return redirect()->route('tours.index');
    }
}
