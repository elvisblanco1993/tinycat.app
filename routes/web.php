<?php

use App\Http\Controllers\FileAccessController;
use App\Http\Controllers\QuickbooksController;
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

    /**
     * Marketing Routes
     */

    // Leads
    Route::get('/leads', \App\Livewire\Lead\Index::class)->name('lead.index');
    Route::get('/leads/{lead}', \App\Livewire\Lead\Show::class)->name('lead.show');
    // Audiences
    Route::get('/audiences', \App\Livewire\Audience\Index::class)->name('audience.index');
    Route::get('/audiences/{audience}', \App\Livewire\Audience\Show::class)->name('audience.show');
    // Email Broadcasts
    Route::get('/broadcasts', \App\Livewire\EmailBroadcast\Index::class)->name('broadcast.index');
    Route::get('/broadcasts/{broadcast}', \App\Livewire\EmailBroadcast\Manage::class)->name('broadcast.manage');
});
