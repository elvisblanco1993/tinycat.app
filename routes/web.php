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

    /**
     * Admin Client Routes
     */
    Route::get('/clients', \App\Livewire\Client\Index::class)->name('client.index');
    Route::get('/clients/{client}', fn($client) => redirect(route('client.files', ['client' => $client])))->name('client.show');
    Route::get('/clients/{client}/edit', \App\Livewire\Client\Update::class)->name('client.update');
    Route::get('/clients/{client}/files/{item?}', \App\Livewire\File\Index::class)->name('client.files');
    Route::get('/clients/{client}/projects', fn() => view('dashboard'))->name('client.projects');

    /**
     * Requests Routes
     */
    Route::get('/clients/{client}/requests', \App\Livewire\UploadRequest\Index::class)->name('upload-request.index');
    Route::get('/clients/{client}/requests/{request}', \App\Livewire\UploadRequest\Show::class)->name('upload-request.show');

    /**
     * Project Routes
     */
    Route::get('/projects', fn() => view('dashboard') )->name('project.index');
    Route::get('/forms', \App\Livewire\Form\Index::class)->name('form.index');
    Route::get('/forms/{form}', \App\Livewire\Form\Show::class)->name('form.show');

    /**
     * Image manipulation routes
     */
    Route::get('/get-thumbnail/{item}', [FileAccessController::class, 'downloadThumbnail'])->name('thumbnail');
    Route::get('/download/{item}', [FileAccessController::class, 'downloadPrivately'])->name('download');

    // @TODO: Create middleware to only allow clients to see these routes.
    Route::prefix('my')
        ->group(function() {
            Route::get('/files', fn() => view('dashboard') )->name('my.request.show');
            Route::get('/projects', fn() => view('dashboard') )->name('my.request.show');
            Route::get('/requests/{request}/upload', fn() => view('dashboard') )->name('my.request.show');
        });
});
