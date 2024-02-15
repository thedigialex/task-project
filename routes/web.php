<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/company', [CompanyController::class, 'overview'])->name('companies.company');
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::get('/companies/edit/{id}', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::post('/companies/{id?}', [CompanyController::class, 'store'])->name('companies.store');
    Route::put('/companies/{id}', [CompanyController::class, 'store'])->name('companies.update');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id?}', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'store'])->name('users.update');

     // Projects
     Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
     Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
     Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
     Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
     Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
     Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
     Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
 

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
