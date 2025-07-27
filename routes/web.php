<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/books/search', [BooksController::class, 'search'])->name('books.search');
Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
Route::get('/copies/search', [CategoryController::class, 'search'])->name('copies.search');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::resource('books', BooksController::class);
Route::resource('copies', CopyController::class);
Route::resource('reservations', ReservationController::class);
Route::resource('categories', CategoryController::class);




require __DIR__.'/auth.php';
