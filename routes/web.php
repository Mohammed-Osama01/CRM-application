<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard/trash', [UserController::class, 'trash'])->name('Client.trash');

    Route::get('dashboard/{id}/restore', [UserController::class, 'restore'])->name('Client.restore');

    Route::get('dashboard/{id}/forcedelete', [UserController::class, 'forcedelete'])->name('Client.forcedelete');

    // Route::get('dashboard/restore-all', [UserController::class, 'restore_all'])->name('Client.restore_all');

    // Route::get('dashboard/delete-all', [UserController::class, 'delete_all'])->name('Client.delete_all');

    Route::resource('dashboard', UserController::class);
    Route::post('dashboard/create', [UserController::class, 'store'])->name('dashboard.store');

    Route::post('/dashboard', [UserController::class, 'logout'])->name('logout');
});

require __DIR__ . '/auth.php';
