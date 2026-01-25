<?php

use App\Http\Controllers\Admin\DashboardController;

Route::middleware(['auth', 'admin'])->group(function () {

    // Admin Dashboard (primary route)
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Dashboard alias for backward compatibility
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


});


