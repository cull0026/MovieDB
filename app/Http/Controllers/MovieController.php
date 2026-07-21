<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //GET: /api/movies	returns all movies
        return response()->json(Movie::all());
            //return MovieResource::collection(Movie::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //POST: /api/movies	creates a new movie with optional genres
        $movie = Movie::create([
            'title' => $request->title,
            'release_year' => $request->release_year,
        ]);

        //if(isset($request['genres'])){
        if ($request->has('genre_ids')){
            $movie->genres()->attach($request['genre_ids']);
        }

        $movie->load('genres');
        return new MovieResource($movie);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //GET: /api/movies/{id}	returns a single movie including genre names
            //$movie = Movie::findOrFail($id);
            //return response()->json($movie);
        return new MovieResource(Movie::with('genres')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, Request $request)
    {
        //PUT: /api/movies/{id}	updates a movie data including genres
        $movie = Movie::findOrFail($id);
        $movie->update([
           'title' => $request->title,
            'release_year' => $request->release_year,
        ]);

        //if(isset($request['genres'])){
        if ($request->has('genre_ids')){
            $movie->genres()->sync($request['genre_ids']);
        }

        return new MovieResource($movie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //DELETE: /api/movies/{id}	deletes a movie include any rows on pivot table
        $movie = Movie::findOrFail($id);

        $movie->genres()->detach();
        $movie->delete();

        return response()->noContent();
    }
}
