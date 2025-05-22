<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'rating' => 'required|numeric|min:0.5|max:5.0',
            'comment' => 'nullable|string|max:1000',
            'watched_date' => 'nullable|date|before_or_equal:today'
        ]);

        $validated['user_id'] = Auth::id();

        // Verifica se já existe uma review do usuário para este filme
        $existingReview = Review::where('user_id', Auth::id())
                               ->where('movie_id', $validated['movie_id'])
                               ->first();

        if ($existingReview) {
            $existingReview->update($validated);
            $message = 'Review atualizada com sucesso!';
        } else {
            Review::create($validated);
            $message = 'Review adicionada com sucesso!';
        }

        return redirect()->route('movies.show', $validated['movie_id'])
                        ->with('success', $message);
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        $movieId = $review->movie_id;
        $review->delete();

        return redirect()->route('movies.show', $movieId)
                        ->with('success', 'Review removida com sucesso!');
    }

    public function index()
    {
        $reviews = Review::with(['movie', 'user'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('reviews.index', compact('reviews'));
    }
}