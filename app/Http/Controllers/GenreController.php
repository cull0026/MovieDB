<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreResource;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //GET: /api/genres	returns all genres
        return response()->json(Genre::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //GET: /api/genres/{id}	returns a single genre with movie titles and ids
        return new GenreResource(Genre::with('movies')->findOrFail($id));
    }
}
