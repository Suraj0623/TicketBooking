<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;
use App\Models\Seat;
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
            'number' => ['required', 'regex:/^[A-Z]{2} \d{1,2} [A-Z]{2,3} \d{4}$/'],
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'departure_date' => 'required|date|after_or_equal:today', //  valid date after today
            'departure_time' => 'required|date_format:H:i', //  time is in HH:mm format
            'capacity' => 'required|integer|min:1', // 
            'ticket_price' => 'required|numeric|min:0',
        ]);
  // Handle file upload (if a file is provided)
  if ($request->hasFile('image')) {
    $path = $request->file('image')->store('transports', 'public'); // Store the file in the 'storage/app/public/posters' directory
    $validated['image'] = $path; // Add the file path to the validated data
}

        // Create a new transport record
        $transport = Transport::create($validated);

        for ($i = 1; $i <= $request->capacity; $i++) {
            $seatNumber = 'S' . $i; // Example seat numbering: S1, S2, S3...
            $transport->seats()->create([
                'seat_number' => $seatNumber,
                'status' => 'available',
            ]);
        }


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
        $transport = Transport::findOrFail($id);
        $routes = Route::all(); // Retrieve all routes for the dropdown

        return view('admin.transports.edit', compact('transport', 'routes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'type' => 'required|in:bus,plane,train',
            'name' => 'required|string|max:255',
            'number' => ['required', 'regex:/^[A-Z]{2} \d{1,2} [A-Z]{2,3} \d{4}$/'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'departure_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required|date_format:H:i',
            'capacity' => 'required|integer|min:1',
            'ticket_price' => 'required|numeric|min:0',
        ]);

        $transport = Transport::findOrFail($id);

        // Handle file upload (if a new file is provided)
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($transport->image) {
                Storage::disk('public')->delete($transport->image);
            }
            $path = $request->file('image')->store('transports', 'public');
            $validated['image'] = $path;
        }

        // Update the transport record
        $transport->update($validated);

        // Update seats only if capacity changes
        if ($request->capacity != $transport->seats()->count()) {
            $transport->seats()->delete(); // Remove existing seats
            for ($i = 1; $i <= $request->capacity; $i++) {
                $seatNumber = 'S' . $i;
                $transport->seats()->create([
                    'seat_number' => $seatNumber,
                    'status' => 'available',
                ]);
            }
        }

        return redirect()->route('transports.index')->with('success', 'Transport updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transport = Transport::findorFail($id);
        $transport->delete();
        return redirect()->route('transports.index')->with('success', 'Transport deleted successfully');

    }
}
