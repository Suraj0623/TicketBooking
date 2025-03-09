<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required|date',
            'venue' => 'required|string|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'total_seats' => 'required|integer|min:1',
            'category' => 'required|string|max:255', // Add validation for category
        ]);

        $event = Event::create($request->all());

        // Generate seat entries for the event
        for ($i = 1; $i <= $request->total_seats; $i++) {
            $seatNumber = 'S' . $i; // Example seat numbering: S1, S2, S3...
            $event->seats()->create([
                'seat_number' => $seatNumber,
                'status' => 'available',
            ]);
        }

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
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
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required|date',
            'venue' => 'required',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ticket_price' => 'required|numeric',
            'total_seats' => 'required|integer|min:1',
            'category' => 'required|string|max:255', // Add validation for category
        ]);
  // Handle file upload (if a file is provided)
  if ($request->hasFile('image')) {
    $path = $request->file('image')->store('events', 'public'); // Store the file in the 'storage/app/public/posters' directory
    $validated['image'] = $path; // Add the file path to the validated data
}
        $event = Event::find($id);
        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');

    }
}
