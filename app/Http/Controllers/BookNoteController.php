<?php

namespace App\Http\Controllers;

use App\Models\BookNote;
use App\Models\BookTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookNoteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_tracker_id' => 'required|exists:book_trackers,id',
            'page_start' => 'required|integer',
            'page_end' => 'required|integer|gte:page_start',
            'notes' => 'required|string',
        ]);

        $bookTracker = BookTracker::findOrFail($validated['book_tracker_id']);
        if ($bookTracker->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $note = BookNote::create([
            'book_tracker_id' => $validated['book_tracker_id'],
            'page_start' => $validated['page_start'],
            'page_end' => $validated['page_end'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('book_trackers.index')->with('success', 'Catatan berhasil disimpan!');
    }

    public function update(Request $request, BookNote $bookNote)
    {
        if ($bookNote->bookTracker->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'page_start' => 'required|integer',
            'page_end' => 'required|integer|gte:page_start',
            'notes' => 'required|string',
        ]);

        $bookNote->update([
            'page_start' => $validated['page_start'],
            'page_end' => $validated['page_end'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('book_trackers.index')->with('success', 'Catatan berhasil diperbarui!');
    }

    public function destroy(BookNote $bookNote)
    {
        if ($bookNote->bookTracker->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $bookNote->delete();

        return redirect()->route('book_trackers.index')->with('success', 'Catatan berhasil dihapus!');
    }
}
