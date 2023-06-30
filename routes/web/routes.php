<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', config('jetstream.auth_session')])->group(static function (): void {
    Route::get('/', static fn () => view('welcome'));
    Route::get('dashboard', static fn () => view('dashboard'))->name('dashboard');
});
