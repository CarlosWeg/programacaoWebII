<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::query();

        if ($request->filled('search')) {
            $query->where('title', 'ILIKE', '%' . $request->search . '%')
                  ->orWhere('director', 'ILIKE', '%' . $request->search . '%');
        }

        $movies = $query->withCount('reviews')
                       ->with(['reviews' => function($q) {
                           $q->selectRaw('movie_id, AVG(rating) as avg_rating')
                             ->groupBy('movie_id');
                       }])
                       ->paginate(20);

        return response()->json($movies);
    }

    public function show(Movie $movie)
    {
        $movie->load(['reviews.user']);
        $movie->avg_rating = $movie->averageRating();
        $movie->total_reviews = $movie->totalReviews();

        return response()->json($movie);
    }
}