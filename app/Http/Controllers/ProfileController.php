<?php

namespace App\Http\Controllers;

use App\Models\Partner;
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
         // Validate incoming data
         $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'father_name'           => 'nullable|string|max:255',
            'grandfather_name'      => 'nullable|string|max:255',
            'gender'                => 'required|in:Male,Female,Other',
            'marital_status'        => 'required|in:Single,Married,Divorced,Widowed',
            'dob'                   => 'required|date',
            'nationality'           => 'required|string|max:255',
            'email'                 => 'required|email|unique:users_information,email',
            'phone'                 => 'nullable|string|max:20',

            // Identity Details
            'identity_type'         => 'required|string|max:255',
            'identity_number'       => 'required|string|unique:users_information,identity_number',
            'document_issued_date'  => 'nullable|date',
            'document_front'        => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'document_back'         => 'nullable|file|mimes:jpg,png,pdf|max:2048',

            // Permanent Address
            'permanent_province'    => 'required|string|max:255',
            'permanent_district'    => 'required|string|max:255',
            'permanent_municipality'=> 'required|string|max:255',
            'permanent_street'      => 'nullable|string|max:255',

            // Temporary Address
            'is_temporary_same'     => 'sometimes|boolean',
            'temporary_province'    => 'nullable|string|max:255',
            'temporary_district'    => 'nullable|string|max:255',
            'temporary_municipality'=> 'nullable|string|max:255',
            'temporary_street'      => 'nullable|string|max:255',
        ]);

        // Handle file uploads
        if ($request->hasFile('document_front')) {
            $validated['document_front'] = $request->file('document_front')->store('documents', 'public');
        }
        if ($request->hasFile('document_back')) {
            $validated['document_back'] = $request->file('document_back')->store('documents', 'public');
        }

        // If "Same as Permanent Address" is checked, copy permanent address to temporary
        if ($request->input('is_temporary_same')) {
            $validated['temporary_province'] = $validated['permanent_province'];
            $validated['temporary_district'] = $validated['permanent_district'];
            $validated['temporary_municipality'] = $validated['permanent_municipality'];
            $validated['temporary_street'] = $validated['permanent_street'];
        }

        // Save data to database
        Partner::create($validated);

        return redirect()->route('profile.index')->with('success', 'User information stored successfully!');
    
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
