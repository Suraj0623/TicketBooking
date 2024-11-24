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
        ]);

       $event= Event::create($request->all());
       $event->seats()->create([
        'total_seats'=>$request->total_seats,
        'available_seats'=>$request->total_seats,
        'seatable_id' => $event->id,
        'seatable_type' => Event::class,
       ]);

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
    public function edit(string $id)
    {
        return view('admin.events.edit', compact('id'));
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
            'ticket_price' => 'required|numeric',
            'total_seats' => 'required|integer|min:1',
        ]);
        $event=Event::find($id);
        $event->update($request->all());
        return redirect()->route('events.index')->with('success', 'Event updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event=Event::find($id);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');

    }
}
