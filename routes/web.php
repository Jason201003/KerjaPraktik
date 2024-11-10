<?php

use App\Http\Controllers\KamarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');   
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Edit, Update, Delete Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Insert, Update, Delete Kamars
    Route::get('kelola-kamar', [KamarController::class, 'loadAllKamars'])->name('kelola-kamar');
    Route::get('add-kamar', [KamarController::class, 'loadAddKamarForm']);
    Route::post('add-kamar', [KamarController::class, 'AddKamar'])->name('AddKamar');
    Route::get('edit-kamar-{id}', [KamarController::class, 'loadEditForm']);
    Route::put('edit-kamar-{id}', [KamarController::class, 'EditKamar'])->name('EditKamar');
    Route::delete('delete-kamar-{id}', [KamarController::class, 'DeleteKamar'])->name('kamar.delete');
    Route::get('kamar-search', [KamarController::class, 'search'])->name('kamar.search');

    // Insert, Update, Delete Users
    Route::get('kelola-user/{role}', [UserController::class, 'loadAllUsers'])->name('user');
    Route::get('kelola-user-search/{role}', [UserController::class, 'search'])->name('users.search');
    Route::get('kelola-users/{role}', [UserController::class, 'loadAllUsers']);
    Route::get('kelola-user-add-{role}', [UserController::class, 'loadAddForm']);
    Route::post('kelola-user-add-{role}', [UserController::class, 'AddUser'])->name('AddUser');
    Route::get('edit-kelola-user/{id}/{role}', [UserController::class, 'loadEditForm'])->name('edit-user');
    Route::put('edit-kelola-user/{id}/{role}', [UserController::class, 'EditUser'])->name('EditUser');
    Route::get('delete-kelola-user/{id}/{role}', [UserController::class, 'deleteUser'])->name('user.delete');
    });

require __DIR__.'/auth.php';
