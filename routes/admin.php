<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', function () {
        return view('dashboard');
    })->name('admin.dashboard');

});


