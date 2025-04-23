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

        return redirect()->route('book-trackers.show', $tracker->id)->with('success', 'Progress berhasil diupdate!');
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
