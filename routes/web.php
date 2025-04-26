<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookNoteController;
use App\Http\Controllers\UserBookController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookTrackerController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Management\BookController;
use App\Http\Controllers\Management\GenreController;
use App\Http\Controllers\Management\AuthorController;

// Home Page
Route::get('/', fn() => view('home'))->name('home');

// Search functrionality
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// =====================
// Login Routes
// =====================
Route::get('/login', [LoginController::class, 'formLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterController::class, 'formRegister'])->name('register');
Route::post('/register/post', [RegisterController::class, 'register'])->name('register.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// =====================
// User Routes (auth)
// =====================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PagesController::class, 'home'])->name('dashboard.user');
    Route::get('/mybooks', [PagesController::class, 'mybooks'])->name('my-books');

    // User Books Routes
    Route::prefix('user-books')->name('user-books.')->group(function () {
        Route::get('/', [UserBookController::class, 'index'])->name('index');
        Route::get('/create', [UserBookController::class, 'create'])->name('create');
        Route::post('/', [UserBookController::class, 'store'])->name('store');
        Route::get('/{userBook}', [UserBookController::class, 'show'])->name('show');
        Route::get('/{userBook}/edit', [UserBookController::class, 'edit'])->name('edit');
        Route::put('/{userBook}', [UserBookController::class, 'update'])->name('update');
        Route::delete('/{userBook}', [UserBookController::class, 'destroy'])->name('destroy');
    });

    // Book Tracker Routes
    Route::prefix('book-trackers')->name('book-trackers.')->group(function () {
        Route::get('/', [BookTrackerController::class, 'index'])->name('index');
        Route::get('/create', [BookTrackerController::class, 'create'])->name('create');
        Route::post('/', [BookTrackerController::class, 'store'])->name('store');
        Route::get('/{bookTracker}', [BookTrackerController::class, 'show'])->name('show');
        Route::get('/{bookTracker}/edit', [BookTrackerController::class, 'edit'])->name('edit');
        Route::put('/{bookTracker}', [BookTrackerController::class, 'update'])->name('update');
        Route::delete('/{bookTracker}', [BookTrackerController::class, 'destroy'])->name('destroy');
        Route::put('/{bookTracker}/progress', [BookTrackerController::class, 'updateProgress'])->name('updateProgress');
    });

    // Book Notes Routes
    Route::prefix('book-notes')->name('book-notes.')->group(function () {
        Route::post('/', [BookNoteController::class, 'store'])->name('store');
        Route::put('/{bookNote}', [BookNoteController::class, 'update'])->name('update');
        Route::delete('/{bookNote}', [BookNoteController::class, 'destroy'])->name('destroy');
    });

});

// =====================
// Admin / Management Routes
// =====================
// Route::middleware(['auth', 'role:admin'])->group(function () {

// Genres Management
Route::prefix('genres')->name('genres.')->group(function () {
    Route::get('/', [GenreController::class, 'index'])->name('index');
    Route::get('/create', [GenreController::class, 'create'])->name('create');
    Route::post('/', [GenreController::class, 'store'])->name('store');
    Route::get('/{genre}', [GenreController::class, 'show'])->name('show');
    Route::get('/{genre}/edit', [GenreController::class, 'edit'])->name('edit');
    Route::put('/{genre}', [GenreController::class, 'update'])->name('update');
    Route::delete('/{genre}', [GenreController::class, 'destroy'])->name('destroy');
});

// Authors Management
Route::prefix('authors')->name('authors.')->group(function () {
    Route::get('/', [AuthorController::class, 'index'])->name('index');
    Route::get('/create', [AuthorController::class, 'create'])->name('create');
    Route::post('/', [AuthorController::class, 'store'])->name('store');
    Route::get('/{author}', [AuthorController::class, 'show'])->name('show');
    Route::get('/{author}/edit', [AuthorController::class, 'edit'])->name('edit');
    Route::put('/{author}', [AuthorController::class, 'update'])->name('update');
    Route::delete('/{author}', [AuthorController::class, 'destroy'])->name('destroy');
});

// Books Management
Route::prefix('books')->name('books.')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('index');
    Route::get('/create', [BookController::class, 'create'])->name('create');
    Route::post('/', [BookController::class, 'store'])->name('store');
    Route::get('/{book}/edit', [BookController::class, 'edit'])->name('edit');
    Route::put('/{book}', [BookController::class, 'update'])->name('update');
    Route::delete('/{book}', [BookController::class, 'destroy'])->name('destroy');
});

// });

// Fallback - 404
// Route::fallback(fn() => view('errors.404'))->name('404');
