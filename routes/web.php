<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\BugController;
use App\Models\Bug;

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

Route::middleware(['auth', 'verified', 'client.company'])->group(function () {

    Route::middleware(['admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/company/{company}', [CompanyController::class, 'adminview'])->name('companies.admin');
    });

    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');    
    Route::put('/users/{userId}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/edit/{userId}', [UserController::class, 'edit'])->name('users.edit');
    Route::resource('companies', CompanyController::class);
    
    Route::put('/projects/{projectId}', [ProjectController::class, 'update'])->name('projects.update');
    Route::get('/projects/create/{companyId}', [ProjectController::class, 'create'])->name('projects.create');
    Route::get('/projects/edit/{projectId}', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('/projects/{companyId}', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{projectId}', [ProjectController::class, 'show'])->name('projects.show');
    Route::delete('/projects/{projectId}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('/tasks/create/{phaseId}', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('/tasks/edit/{taskId}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::post('/tasks/{phaseId}', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/{taskId}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{taskId}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('/phases/create/{projectId}', [PhaseController::class, 'create'])->name('phases.create');
    Route::get('/phases/edit/{phaseId}', [PhaseController::class, 'edit'])->name('phases.edit');
    Route::post('/phases/{projectId}', [PhaseController::class, 'store'])->name('phases.store');
    Route::put('/phases/{phaseId}', [PhaseController::class, 'update'])->name('phases.update');
    Route::get('/phases/{phaseId}', [PhaseController::class, 'show'])->name('phases.show');
    Route::delete('/phases/{phaseId}', [PhaseController::class, 'destroy'])->name('phases.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/bugs/create/{projectId}', [BugController::class, 'create'])->name('bugs.create');
    Route::post('/bugs/{projectId}', [BugController::class, 'store'])->name('bugs.store');
    Route::put('/bugs/{bugId}', [BugController::class, 'update'])->name('bugs.update');
    Route::get('/bugs/edit/{bugId}', [BugController::class, 'edit'])->name('bugs.edit');
    Route::delete('/bugs/{bugId}', [BugController::class, 'destroy'])->name('bugs.destroy');

    Route::get('/tasks/{taskId}/subtasks', [SubTaskController::class, 'index'])->name('subtasks.index');
    Route::post('/tasks/{taskId}/subtasks', [SubTaskController::class, 'store'])->name('subtasks.store');
    Route::get('/tasks/{taskId}/subtasks/create', [SubTaskController::class, 'create'])->name('subtasks.create');
    Route::put('/subtasks/{subtaskId}', [SubTaskController::class, 'update'])->name('subtasks.update');
    Route::get('/subtasks/{subtaskId}/edit', [SubTaskController::class, 'edit'])->name('subtasks.edit');
    Route::delete('/subtasks/{subtaskId}', [SubTaskController::class, 'destroy'])->name('subtasks.destroy');
    Route::patch('/subtasks/{subtask}/toggle',  [SubTaskController::class, 'toggleComplete'])->name('subtasks.toggleComplete');

});

require __DIR__ . '/auth.php';
