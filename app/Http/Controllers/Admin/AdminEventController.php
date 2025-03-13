<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'total_seats' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'event_date' => 'required|date',
            'venue' => 'required|string|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255', // Add validation for category
        ]);

        $data = $request->only([
            'title',
            'description',
            'total_seats',
            'event_date',
            'venue',
            'ticket_price',
            'category', // Include 'category'
        ]);

        // Handle file upload (if a file is provided)
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public'); // Store the file in the 'storage/app/public/events' directory
            $data['image'] = $path; // Add the file path to the validated data
        }

        $event = Event::create($data);

        // Generate seat entries for the event
        if ($request->total_seats) {
            for ($i = 1; $i <= $request->total_seats; $i++) {
                $seatNumber = 'S' . $i;
                $event->seats()->create([
                    'seat_number' => $seatNumber,
                    'status' => 'available',
                ]);
            }
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
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'total_seats' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'event_date' => 'required|date',
            'venue' => 'required|string|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255', // Add validation for category
        ]);

        $data = $request->only([
            'title',
            'description',
            'total_seats',
            'event_date',
            'venue',
            'ticket_price',
            'category', // Include 'category'
        ]);

        // Handle file upload (if a new file is provided)
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $path = $request->file('image')->store('events', 'public');
            $data['image'] = $path;
        }

        $event->update($data);

        // Update seats only if capacity changes
        if ($request->total_seats != $event->seats()->count()) {
            $event->seats()->delete(); // Remove existing seats
            if ($request->total_seats) {
                for ($i = 1; $i <= $request->total_seats; $i++) {
                    $seatNumber = 'S' . $i;
                    $event->seats()->create([
                        'seat_number' => $seatNumber,
                        'status' => 'available',
                    ]);
                }
            }
        }

        return redirect()->route('events.index')->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        // Delete associated seats
        $event->seats()->delete();

        // Delete the event
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}