<?php

use App\Http\Controllers\FileAccessController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/login'));

/**
 * Auth: Team member signup route.
 */
Route::get('/register/invitation/{invitation}', \App\Livewire\Auth\RegisterWithInvitation::class)->name('register-with-invitation');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // Clients
    Route::get('/clients', \App\Livewire\Client\Index::class)->name('client.index');
    Route::get('/clients/{client}', \App\Livewire\Client\Show::class)->name('client.show');
    Route::get('/clients/{client?}/files/{item?}', \App\Livewire\File\Index::class)->name('client.file.index');
    Route::get('/clients/{client?}/tasks', \App\Livewire\Task\Index::class)->name('client.task.index');
    Route::get('/clients/{client}/edit', \App\Livewire\Client\Update::class)->name('client.update');

    // Attachments
    Route::get('/get-thumbnail/{item}', [FileAccessController::class, 'downloadThumbnail'])->name('thumbnail');
    Route::get('/download/{item}', [FileAccessController::class, 'downloadPrivately'])->name('download');
});
