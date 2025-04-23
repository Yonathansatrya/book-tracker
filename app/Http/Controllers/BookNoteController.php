<?php

namespace App\Http\Controllers;

use App\Models\BookNote;
use App\Models\BookTracker;
use App\Models\BookUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookNoteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_user_id' => 'required|exists:book_users,id',
            'page_start' => 'required|integer',
            'page_end' => 'required|integer|gte:page_start',
            'notes' => 'required|string',
        ]);

        $bookUser = BookUser::findOrFail($validated['book_user_id']);
        if ($bookUser->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $note = BookNote::create([
            'book_user_id' => $validated['book_user_id'],
            'page_start' => $validated['page_start'],
            'page_end' => $validated['page_end'],
            'notes' => $validated['notes'],
        ]);

        return redirect()
            ->route('book-trackers.show', $bookUser->id)
            ->with('success', 'Catatan berhasil disimpan!');

    }

    public function update(Request $request, BookNote $bookNote)
    {
        if ($bookNote->bookUser->user_id !== Auth::id()) {
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

        return redirect()
        ->route('book-trackers.show', $bookUser->id)
        ->with('success', 'Catatan berhasil disimpan!');
    }

    public function destroy(BookNote $bookNote)
    {
        if ($bookNote->bookUser->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $bookNote->delete();

        return redirect()
        ->route('book-trackers.show', $bookUser->id)
        ->with('success', 'Catatan berhasil disimpan!');
    }
}
