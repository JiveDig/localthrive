<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Test route for vote button
Route::get('/test-vote', function () {
    $testNomination = [
        'ranking_id' => 1, // We'll need to replace this with a real UUID from your rankings table
        'place' => ['id' => 1], // We'll need to replace this with a real UUID from your places table
        'vote_total' => 0
    ];
    return view('test-vote', ['nomination' => $testNomination]);
})->name('test-vote');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
