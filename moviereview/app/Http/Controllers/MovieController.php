<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::query();

        // Filtros de busca
        if ($request->filled('search')) {
            $query->where('title', 'ILIKE', '%' . $request->search . '%')
                  ->orWhere('director', 'ILIKE', '%' . $request->search . '%');
        }

        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        $movies = $query->withCount('reviews')
                       ->orderBy('created_at', 'desc')
                       ->paginate(12);

        $genres = Movie::select('genre')->distinct()->pluck('genre');
        $years = Movie::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');

        return view('movies.index', compact('movies', 'genres', 'years'));
    }

    public function show(Movie $movie)
    {
        $movie->load(['reviews.user']);
        $userReview = null;
        
        if (Auth::check()) {
            $userReview = Review::where('user_id', Auth::id())
                               ->where('movie_id', $movie->id)
                               ->first();
        }

        return view('movies.show', compact('movie', 'userReview'));
    }

    public function create()
    {
        $this->authorize('create', Movie::class);
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Movie::class);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 2),
            'genre' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster_url' => 'nullable|url',
            'duration' => 'required|integer|min:1'
        ]);

        Movie::create($validated);

        return redirect()->route('movies.index')
                        ->with('success', 'Filme adicionado com sucesso!');
    }

    public function edit(Movie $movie)
    {
        $this->authorize('update', $movie);
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $this->authorize('update', $movie);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 2),
            'genre' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster_url' => 'nullable|url',
            'duration' => 'required|integer|min:1'
        ]);

        $movie->update($validated);

        return redirect()->route('movies.show', $movie)
                        ->with('success', 'Filme atualizado com sucesso!');
    }

    public function destroy(Movie $movie)
    {
        $this->authorize('delete', $movie);
        $movie->delete();

        return redirect()->route('movies.index')
                        ->with('success', 'Filme removido com sucesso!');
    }
}