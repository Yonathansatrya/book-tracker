<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookTracker;
use App\Models\BookUser;
use Illuminate\Http\Request;

class BookTrackerController extends Controller
{
    public function show($id)
    {
        $tracker = BookUser::with(['book', 'notes'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('book_tracker.show', compact('tracker'));
    }

    public function index()
    {
        $trackers = BookUser::where('user_id', auth()->id())->with('book')->get();
        return view('book_tracker.index', compact('trackers'));
    }

    public function create()
    {
        $books = Book::all();
        return view('book_tracker.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'status' => 'required|in:want_to_read,reading,finished',
            'last_read_page' => 'required|integer|min:0',
            'rating' => 'nullable|integer|between:1,5',
            'started_at' => 'nullable|date',
            'finished_at' => 'nullable|date|after_or_equal:started_at',
        ]);

        BookUser::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'status' => $request->status,
            'last_read_page' => $request->last_read_page,
            'rating' => $request->rating,
            'started_at' => $request->started_at,
            'finished_at' => $request->finished_at,
        ]);

        return redirect()->route('book-trackers.index')->with('success', 'Progres buku berhasil ditambahkan.');
    }

    public function rating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $tracker = BookUser::findOrFail($id);

        $tracker->rating = $request->rating;
        $tracker->save();

        $book = $tracker->book;
        $totalRatings = $book->users()->whereNotNull('rating')->count();
        $averageRating = $book->users()->whereNotNull('rating')->avg('rating');
        $book->average_rating = round($averageRating, 2);
        $book->ratings_count = $totalRatings;

        $book->save();

        return redirect()->route('book-trackers.show', $tracker->id)->with('success', 'Rating berhasil diperbarui!');
    }

    public function edit($id)
    {
        $books = Book::all();
        $tracker = BookUser::findOrFail($id);
        return view('book_tracker.edit', compact('books', 'tracker'));
    }

    public function update(Request $request, BookUser $bookUser)
    {
        if ($bookUser->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:want_to_read,reading,finished',
            'last_read_page' => 'required|integer|min:0',
            'rating' => 'nullable|integer|between:1,5',
            'started_at' => 'nullable|date',
            'finished_at' => 'nullable|date|after_or_equal:started_at',
        ]);

        $bookUser->update([
            'status' => $request->status,
            'last_read_page' => $request->last_read_page,
            'rating' => $request->rating,
            'started_at' => $request->started_at,
            'finished_at' => $request->finished_at,
        ]);
        return redirect()->route('book-trackers.index')->with('success', 'Progres buku berhasil diperbarui.');
    }

    public function updateProgress(Request $request, $id)
    {
        $tracker = BookUser::findOrFail($id);

        $tracker->last_read_page = $request->last_read_page;
        $tracker->save();

        $this->updateStatus($tracker);

        return redirect()->route('book-trackers.show', $tracker->id)->with('success', 'Progress berhasil diupdate!');
    }

    public function updateStatus(BookUser $bookUser)
    {
        if ($bookUser->last_read_page == 0) {
            $bookUser->status = 'want_to_read';
        } elseif ($bookUser->last_read_page == $bookUser->book->total_page) {
            $bookUser->status = 'finished';
        } else {
            $bookUser->status = 'reading';
        }

        $bookUser->save();
    }

    public function destroy(BookUser $bookUser)
    {
        if ($bookUser->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $bookUser->delete();

        return redirect()->route('book-trackers.index')->with('success', 'Progres buku berhasil dihapus.');
    }
}
