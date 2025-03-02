<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Http\Request;

class ScreeningController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $screening = Screening::when($search, function ($query, $search) {
            return $query->where('cinema', 'like', "%{$search}%");
        })->get();
        // $movies = Movie::when($search, function ($query, $search) {
        //     return $query->where('title', 'like', "%{$search}%")
        //         ->orWhere('description', 'like', "%{$search}%");
        // })->get();

        return view('movies.show', compact('screening'));


    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function edit(Screening $screening)
    {

    }

    public function update(Request $request, Screening $screening)
    {

    }

    public function destroy(Screening $screening)
    {

    }
}
