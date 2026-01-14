<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $companyProfile = \App\Models\CompanyProfile::first();
    $aboutUs = \App\Models\AboutUs::first();
    return view('frontend', compact('companyProfile', 'aboutUs'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Company Profile Routes
    Route::get('/company-profile/edit', [CompanyProfileController::class, 'edit'])->name('company-profile.edit');
    Route::post('/company-profile/update', [CompanyProfileController::class, 'update'])->name('company-profile.update');

    // About Us Routes
    Route::get('/about-us/edit', [\App\Http\Controllers\AboutUsController::class, 'edit'])->name('about-us.edit');
    Route::post('/about-us/update', [\App\Http\Controllers\AboutUsController::class, 'update'])->name('about-us.update');
});

require __DIR__.'/auth.php';
