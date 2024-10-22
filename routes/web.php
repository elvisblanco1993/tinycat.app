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
     * Client Routes
     */
    Route::get('/clients', \App\Livewire\Client\Index::class)->name('client.index');
    Route::get('/clients/{client}', \App\Livewire\Client\Show::class)->name('client.show');
    Route::get('/clients/{client}/files/{item?}', \App\Livewire\File\Index::class)->name('client.files');
    Route::get('/clients/{client}/projects', \App\Livewire\Client\Show::class)->name('client.projects');
    Route::get('/clients/{client}/upload-requests', \App\Livewire\UploadRequest\Index::class)->name('client.requests');

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
});
