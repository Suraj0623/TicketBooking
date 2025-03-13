<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048', // Image validation
            'packageName' => 'required',
            'ticket_price' => 'required|numeric',
            'duration' => 'required',
            'highlights' => 'required',
            'capacity' => 'required|integer|min:1|max:35',
            'category' => 'required|string|max:255', // Add validation for category
        ]);

        // Store the image and get the file path
        $path = $request->file('image')->store('tours', 'public'); // Fixed the folder path to be consistent

        // Create the new tour and save the image path
        $tour = Tour::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path, // Store the image path in the database
            'packageName' => $request->packageName,
            'ticket_price' => $request->ticket_price,
            'duration' => $request->duration,
            'highlights' => $request->highlights,
            'capacity' => $request->capacity,
            'category' => $request->category, // Add category
        ]);

        // Generate seats based on the capacity
        for ($i = 1; $i <= $request->capacity; $i++) {
            $seatNumber = 'S' . $i; // Example seat numbering: S1, S2, S3...
            $tour->seats()->create([
                'seat_number' => $seatNumber,
                'status' => 'available',
            ]);
        }

        // Redirect back to the tour index page with success message
        return redirect()->route('tours.index')->with('success', 'Tour created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tour = Tour::findOrFail($id);
        return view('admin.tours.show', compact('tour')); 
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
        // Validate the request
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048', 
            'packageName' => 'required',
            'ticket_price' => 'required|numeric',
            'duration' => 'required',
            'highlights' => 'required',
            'capacity' => 'required|integer|min:1|max:35',
            'category' => 'required|string|max:255',
        ]);

        // Find the tour to update
        $tour = Tour::findOrFail($id);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($tour->image) {
                Storage::disk('public')->delete($tour->image);
            }
            $path = $request->file('image')->store('tours', 'public');
            $validated['image'] = $path;
        }

        // Update the tour with the validated data
        $tour->update($validated);
 // Update seats only if capacity changes
 if ($request->capacity != $tour->seats()->count()) {
    $tour->seats()->delete(); // Remove existing seats
    for ($i = 1; $i <= $request->capacity; $i++) {
        $seatNumber = 'S' . $i;
        $tour->seats()->create([
            'seat_number' => $seatNumber,
            'status' => 'available',
        ]);
    }
}
        // Redirect back to the tour index page with success message
        return redirect()->route('tours.index')->with('success', 'Tour updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tour = Tour::findOrFail($id);

        // Delete the tour image if it exists
        if ($tour->image) {
            Storage::disk('public')->delete($tour->image);
        }

        // Delete the tour and associated seats (if needed)
        $tour->delete();

        // Redirect back to the tour index page with success message
        return redirect()->route('tours.index')->with('success', 'Tour deleted successfully.');
    }
}
