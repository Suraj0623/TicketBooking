<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Retrieve the profile of the authenticated user
         $profile = Profile::where('user_id', Auth::id())->firstOrFail();

         // Pass the profile data to the view
         return view('profiles.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        $profile = Profile::where('user_id', Auth::id())->firstOrFail();

        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
{
    // Validate input data
    $request->validate([
        'FirstName' => 'required|string|max:255',
        'LastName' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'mobileNumber' => 'required|digits:10',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
    ]);

    // Update profile details
    $profile->FirstName = $request->input('FirstName');
    $profile->LastName = $request->input('LastName');
    $profile->email = $request->input('email');
    $profile->mobileNumber = $request->input('mobileNumber');

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete the old image if exists
        if ($profile->image && Storage::exists('public/' . $profile->image)) {
            Storage::delete('public/' . $profile->image);
        }

        // Store the new image
        $imagePath = $request->file('image')->store('profiles', 'public');
        $profile->image = $imagePath;
    }

    // Save updated profile
    $profile->save();

    return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
