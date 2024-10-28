<?php

use App\Http\Controllers\FileAccessController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/login'));

/**
 * Auth: Team member signup route.
 */
Route::get(
    '/register/invitation/{invitation}',
    \App\Livewire\Auth\RegisterWithInvitation::class
)->name('register-with-invitation');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Clients
    Route::get('/clients', \App\Livewire\Admin\Client\Index::class)->name(
        'client.index'
    );
    Route::get(
        '/clients/{client}',
        fn ($client) => redirect(route('file.index', ['client' => $client]))
    )->name('client.show');
    Route::get(
        '/clients/{client}/edit',
        \App\Livewire\Admin\Client\Update::class
    )->name('client.update');
    // Projects
    Route::get('/projects/{client?}', fn () => view('dashboard'))->name(
        'project.index'
    );
    Route::get(
        '/projects/{client?}/{project}',
        fn () => view('dashboard')
    )->name('project.show');
    // Upload Requests
    Route::get(
        '/requests/{client?}',
        \App\Livewire\UploadRequest\Index::class
    )->name('upload-request.index');
    Route::get(
        '/requests/{client?}/{request}',
        \App\Livewire\UploadRequest\Show::class
    )->name('upload-request.show');
    Route::get(
        '/requests/{client?}/{request}/upload',
        fn () => view('dashboard')
    )->name('upload-request.complete');
    // Files
    Route::get(
        '/files/{client?}/{item?}',
        \App\Livewire\File\Index::class
    )->name('file.index');
    // Forms
    Route::get('/forms', \App\Livewire\Admin\Form\Index::class)->name(
        'form.index'
    );
    Route::get('/forms/{form}', \App\Livewire\Admin\Form\Show::class)->name(
        'form.show'
    );

    // Attachments
    Route::get('/get-thumbnail/{item}', [
        FileAccessController::class,
        'downloadThumbnail',
    ])->name('thumbnail');
    Route::get('/download/{item}', [
        FileAccessController::class,
        'downloadPrivately',
    ])->name('download');

    // @TODO: Create middleware to only allow clients to see these routes.
    Route::prefix('my')->group(function () {
        Route::get('/tasks', fn () => view('dashboard'))->name('my.task.index');
    });
});
