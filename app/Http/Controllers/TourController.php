<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tours = Tour::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })->get();

        return view('tour.index', compact('tours'));
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
// to do filtering just demo
public function filter(Request $request){
    $tours = Tour::query()->when($request->category,function($query)use($request){
        return $query->where('category',$request->category);
    })->when($request->location,function($query)use($request){
        return $query->where('location',$request->location);
    })->when($request->min_price,function($query)use($request){
        return $query->where('price','>=',$request->min_price);
    })->when($request->max_price,function($query)use($request){
        return $query->where('price','<=',$request->max_price);
    })->orderByDesc('bookings_count')
    ->get();
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tour = Tour::findOrFail($id);
        return view('tour.show', compact('tour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

    }
}
