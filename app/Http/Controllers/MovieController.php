<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use App\Models\Watchlist;

use Illuminate\Http\Request;

class MovieController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $movies = Movie::has('review')->with('review')->latest()->get();

        return view('movies.index', compact('movies'));
    }

        public function watchlist()
    {
            $watchlists = Watchlist::with('movie')->where('watched', false)->orderBy('priority', 'desc')->get();

        return view('watchlist.index', compact('watchlists'));
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
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
