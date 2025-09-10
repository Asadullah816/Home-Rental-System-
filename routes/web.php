<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminPropertyController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('addproperty', [PropertyController::class, 'store'])->name('properties.store');
Route::view('addproperty', 'pages.addproperty')->name('property.form');
// Show single property
// Route::get('property/{property}', [PropertyController::class, 'show'])->name('properties.show');
Route::get('properties', [PropertyController::class, 'showproperty'])->name('showproperties');
Route::get('property/{id}', [PropertyController::class, 'propertydetails'])->name('propertydetails');

// Edit property form
Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
Route::get('/properties/search', [PropertyController::class, 'search'])->name('properties.search');


// Update property
Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');

// Delete property
Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');


Route::prefix('admin/properties')->middleware('admin')->name('admin')->group(function () {
    Route::get('/', [AdminPropertyController::class, 'index'])->name('index'); // Show table
    Route::put('/approve/{id}', [AdminPropertyController::class, 'approve'])->name('approve');
    Route::put('/disapprove/{id}', [AdminPropertyController::class, 'disapprove'])->name('disapprove');
    Route::delete('/{id}', [AdminPropertyController::class, 'destroy'])->name('destroy');
});


require __DIR__ . '/auth.php';
