<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**
 * Auth: Team m ember signup route.
 */
Route::get('/register/invitation/{invitation}', \App\Livewire\Auth\RegisterWithInvitation::class)->name('register-with-invitation');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /**
     * Client Routes
     */
    Route::get('/clients', \App\Livewire\Client\Index::class)->name('client.index');
});
