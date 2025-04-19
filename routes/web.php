<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MybooksController;
use App\Http\Controllers\BookNoteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookTrackerController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ManagementBook\BookController;
use App\Http\Controllers\ManagementBook\GenreController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', [LoginController::class, 'formLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/register', [RegisterController::class, 'formRegister'])->name('register');
Route::post('/register/post', [RegisterController::class, 'register'])->name('register.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// User routes
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.user');

    Route::prefix('my-books')->name('mybooks.')->middleware('auth')->group(function () {
        Route::get('/', [MybooksController::class, 'index'])->name('index');
        Route::get('/create', [MybooksController::class, 'create'])->name('create');
        Route::post('/', [MybooksController::class, 'store'])->name('store');
        Route::get('/{mybook}', [MybooksController::class, 'show'])->name('show');
        Route::get('/{mybook}/edit', [MybooksController::class, 'edit'])->name('edit');
        Route::put('/{mybook}', [MybooksController::class, 'update'])->name('update');
        Route::delete('/{mybook}', [MybooksController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('book-read')->name('book-trackers.')->group(function () {
        Route::get('/read/{bookTracker}',[BookTrackerController::class, 'show'])->name('show');
        Route::get('/', [BookTrackerController::class, 'index'])->name('index');
        Route::get('/create', [BookTrackerController::class, 'create'])->name('create');
        Route::post('/', [BookTrackerController::class, 'store'])->name('store');
        Route::get('/{bookTracker}/edit', [BookTrackerController::class, 'edit'])->name('edit');
        Route::put('/{bookTracker}', [BookTrackerController::class, 'update'])->name('update');
        Route::delete('/{bookTracker}', [BookTrackerController::class, 'destroy'])->name('destroy');
    });

    Route::post('/book-notes', [BookNoteController::class, 'store'])->name('book-notes.store');
    Route::put('/book-notes/{bookNote}', [BookNoteController::class, 'update'])->name('book-notes.update');
    Route::delete('/book-notes/{bookNote}', [BookNoteController::class, 'destroy'])->name('book-notes.destroy');
});

// Admin Routes
// Route::middleware(['auth', 'role:admin'])->group(function () {
Route::prefix('genres')->name('genres.')->group(function () {
    Route::get('/', [GenreController::class, 'index'])->name('index');
    Route::get('/create', [GenreController::class, 'create'])->name('create');
    Route::post('/', [GenreController::class, 'store'])->name('store');
    Route::get('/{genre}', [GenreController::class, 'show'])->name('show');
    Route::get('/{genre}/edit', [GenreController::class, 'edit'])->name('edit');
    Route::put('/{genre}', [GenreController::class, 'update'])->name('update');
    Route::delete('/{genre}', [GenreController::class, 'destroy'])->name('destroy');
});

Route::prefix('books')->name('books.')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('index');
    Route::get('/create', [BookController::class, 'create'])->name('create');
    Route::post('/', [BookController::class, 'store'])->name('store');
    Route::get('/{book}', [BookController::class, 'show'])->name('show');
    Route::get('/{book}/edit', [BookController::class, 'edit'])->name('edit');
    Route::put('/{book}', [BookController::class, 'update'])->name('update');
    Route::delete('/{book}', [BookController::class, 'destroy'])->name('destroy');
});

// });

// 404 Error Route
Route::fallback(function () {
    return view('errors.404');
})->name('404');
