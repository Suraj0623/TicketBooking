<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::all(); // Get all routes
    return view('route.index',compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('route.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation logic
        $validated = $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'duration' => 'required|numeric|min:0',
        ]);
    
        // Store the data
        Route::create($validated);
    
        return redirect()->route('route.index')->with('success', 'Route created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $route = Route::findOrFail($id);
        $route->update([
            'origin' => $request->origin,
            'destination' => $request->destination,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'transport_type' => $request->transport_type,
            'price' => $request->price,
        ]);
        return response()->json($route);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $route = Route::findOrFail($id);
        $route->delete();
        return response()->json(['message' => 'Route deleted successfully']);
    }
}
