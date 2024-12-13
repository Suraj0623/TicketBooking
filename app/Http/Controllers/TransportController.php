<?php

namespace App\Http\Controllers;


use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Retrieve query parameters
    $origin = $request->query('origin');
    $destination = $request->query('destination');
    $departure_date = $request->query('departure_date');

    // Build base query for transports
    $query = Transport::query();

    // Filter by route if origin and destination are provided
    if ($origin && $destination) {
        $query->whereHas('route', function ($query) use ($origin, $destination) {
            $query->where('origin', $origin)
                  ->where('destination', $destination);
        });
    }

    // Filter by departure date if provided
    if ($departure_date) {
        $query->whereDate('departure_date', $departure_date);
    }

    // Separate queries for each transport type
    $buses = (clone $query)->where('type', 'bus')->get();
    $planes = (clone $query)->where('type', 'plane')->get();
    $trains = (clone $query)->where('type', 'train')->get();

    // Return the view with the results
    return view('transports.index', compact('buses', 'planes', 'trains'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Transport $transport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transport $transport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transport $transport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transport $transport)
    {
        //
    }

    public function search(Request $request)
    {
        // Validate input fields
        $validatedData = $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'departure_date' => 'required|date',
        ]);
    
        

        // Query for buses, planes, and trains
        $buses = Transport::whereHas('route', function ($query) use ($validatedData) {
            $query->where('origin', $validatedData['origin'])
                ->where('destination', $validatedData['destination']);
        })
            ->where('type', 'bus')
            ->whereDate('departure_date', $validatedData['departure_date'])
            // ->whereDate('departure_date', '2024-11-20') // Replace with your test date
            ->get();
          
        $planes = Transport::whereHas('route', function ($query) use ($validatedData) {
            $query->where('origin', $validatedData['origin'])
                ->where('destination', $validatedData['destination']);
        })
            ->where('type', 'plane')
            ->whereDate('departure_date', $validatedData['departure_date'])
            ->get();

        $trains = Transport::whereHas('route', function ($query) use ($validatedData) {
            $query->where('origin', $validatedData['origin'])
                ->where('destination', $validatedData['destination']);
        })
            ->where('type', 'train')
            ->whereDate('departure_date', $validatedData['departure_date'])
            ->get();

        return view('transports.index', compact('buses', 'planes', 'trains'));
    }
}
