<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     // Fetch offers from the database
     $offers = Offer::all();  // You can customize this query as needed (e.g., get active offers)

     // Pass the offers data to the view
     return view('home', compact('offers'));  // Ensure 'offers' is passed to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('offerform');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'expiration_date' => 'required|date',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'coupon_code' => 'required|string|max:255',
        ]);

        // Store the image file and get its path
        $imagePath = $request->file('image')->store('offers', 'public');  // 'offers' is the folder inside 'storage/app/public'

        // Create a new offer record
        $offer = new Offer();
        $offer->title = $request->title;
        $offer->expiration_date = $request->expiration_date;
        $offer->image = $imagePath;  // Store the file path
        $offer->coupon_code = $request->coupon_code;
        $offer->save();

        // Redirect to a page (e.g., offers list or offer details page)
        return redirect()->route('offer.index')->with('success', 'Offer created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        //
    }
}
