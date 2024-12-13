<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seat;
use App\Models\Movie;
use App\Models\Route;
use App\Models\Transport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transport = Transport::all();
        $busTransport = $transport->where('type', 'bus');
        $trainTransport = $transport->where('type', 'train');
        $planeTransport = $transport->where('type', 'plane');

        return view('admin.transports.index', compact('busTransport', 'trainTransport', 'planeTransport'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes = Route::all(); // Retrieve all routes from the database
        return view('admin.transports.create', compact('routes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'route_id' => 'required|exists:routes,id', // route exists in the `routes` table
            'type' => 'required|in:bus,plane,train', //  specific types
            'name' => 'required|string|max:255', //  string name
            'departure_date' => 'required|date|after_or_equal:today', //  valid date after today
            'departure_time' => 'required|date_format:H:i', //  time is in HH:mm format
            'capacity' => 'required|integer|min:1', // 
            'ticket_price' => 'required|numeric|min:0',
        ]);


        // Create a new transport record
        $transport=Transport::create($validated);

        Seat::create([
    'seatable_id' => $transport->id,
    'seatable_type' => Transport::class,
    'total_seats' => 100,
    'available_seats' => 100,
]);
        

        return redirect()->route('transports.index')->with('success', 'Transport created successfully!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transport=Transport::findorFail($id);
        $transport->delete();
        return redirect()->route('transports.index')->with('success', 'Transport deleted successfully');

    }
}
