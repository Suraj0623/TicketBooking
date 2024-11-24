<?php
namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies=Movie::with('screenings')->get();
        return view('movies.index',compact('movies'));
    }

    public function create()
    {
        
    }
    public function show($id){
        $movie=Movie::with('screenings')->findOrFail($id);
        return view('movies.show');
    }

    public function store(Request $request)
    {

    }

    public function edit(Movie $movie)
    {
        
    }

    public function update(Request $request, Movie $movie)
    {
    }

    public function destroy(Movie $movie)
    {
    }
    
}
