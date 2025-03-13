<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seat;
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
            'packageName' => 'required',
            'ticket_price' => 'required|numeric',
            'duration' => 'required',
            'highlights' => 'required',
            'capacity'=>'required|integer|min:1|max:35',
            'category' => 'required|string|max:255', // Add validation for category
        ]);

        // Store the image and get the file path
        $path = $request->file('image')->store('storage/tours', 'public');

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

        for ($i = 1; $i <= $request->capacity; $i++) {
            $seatNumber = 'S' . $i; // Example seat numbering: S1, S2, S3...
            $tour->seats()->create([
                'seat_number' => $seatNumber,
                'status' => 'available',
            ]);
        }

        // Redirect back to the tour index page
        return redirect()->route('tours.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tour = Tour::find($id);
        return view('tour.show', compact('tour'));
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
         // Validate the incoming request data
         $validated = $request->validate([
             'title' => 'required|string|max:255',
             'description' => 'required|string',
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Make image optional
             'packageName' => 'required|string|max:255',
             'ticket_price' => 'required|numeric|min:0',
             'duration' => 'required|string|max:255',
             'highlights' => 'required|string',
             'capacity' => 'required|integer|min:1|max:35',
             'category' => 'required|string|max:255',
         ]);
     
         // Find the tour to update
         $tour = Tour::findOrFail($id);
     
         // Handle file upload (if a file is provided)
         if ($request->hasFile('image')) {
             // Delete the old image file if it exists
             if ($tour->image) {
                 Storage::disk('public')->delete($tour->image);
             }
     
             // Store the new image and get the file path
             $path = $request->file('image')->store('tours', 'public');
             $validated['image'] = $path; // Save the new file path
         }
     
         // Update the tour record with the validated data
         $tour->update($validated);
     
         return redirect()->route('tours.index')->with('success', 'Tour updated successfully.');
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
