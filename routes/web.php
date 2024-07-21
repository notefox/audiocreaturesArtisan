<?php

    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
})->name('home');

Route::get('/about', function() {
    return view('pages.about');
})->name('about');

Route::get('/news', function() {
    return view('pages.news');
})->name('news');

Route::get('/portfolio', function () {
    return view('pages.portfolio');
})->name('portfolio');

Route::get('discover', function() {
    return view('pages.discover');
})->name('discover');

Route::get('/credits', function() {
    return view('pages.credits');
})->name('credits');

Route::get('/dashboard', [DashboardController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
