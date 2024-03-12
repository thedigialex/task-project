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
        Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
        Route::get('/company/create', [CompanyController::class, 'create'])->name('companies.create');
        Route::post('/company/store', [CompanyController::class, 'store'])->name('companies.store');
    });

    Route::get('/company', [CompanyController::class, 'show'])->name('companies.show');
    Route::put('/company/update/{companyId}', [CompanyController::class, 'update'])->name('companies.update');
    Route::get('/company/edit/{companyId}', [CompanyController::class, 'edit'])->name('companies.edit');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/user', [UserController::class, 'index'])->name('users.index');
    Route::put('/user/update/{userId}', [UserController::class, 'update'])->name('users.update');
    Route::get('/user/edit/{userId}', [UserController::class, 'edit'])->name('users.edit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/project', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/project/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/project/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/project/{projectId}', [ProjectController::class, 'show'])->name('projects.show');
    Route::put('/project/update/{projectId}', [ProjectController::class, 'update'])->name('projects.update');
    Route::get('/project/edit/{projectId}', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::delete('/project/delete/{projectId}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('/project/phase/create/{projectId}', [PhaseController::class, 'create'])->name('phases.create');
    Route::post('/project/phase/store/{projectId}', [PhaseController::class, 'store'])->name('phases.store');
    Route::get('/project/phase/show/{phaseId}', [PhaseController::class, 'show'])->name('phases.show');
    Route::put('/project/phases/update/{phaseId}', [PhaseController::class, 'update'])->name('phases.update');
    Route::get('/project/phase/edit/{phaseId}', [PhaseController::class, 'edit'])->name('phases.edit');
    Route::delete('/phase/delete/{phaseId}', [PhaseController::class, 'destroy'])->name('phases.destroy');

    Route::get('/bug/create/{projectId}', [BugController::class, 'create'])->name('bugs.create');
    Route::post('/bug/store/{projectId}', [BugController::class, 'store'])->name('bugs.store');
    Route::put('/bug/update/{bugId}', [BugController::class, 'update'])->name('bugs.update');
    Route::get('/bug/edit/{bugId}', [BugController::class, 'edit'])->name('bugs.edit');
    Route::delete('/bugs/delete/{bugId}', [BugController::class, 'destroy'])->name('bugs.destroy');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/task/create/{phaseId}', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('/task/edit/{taskId}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::post('/task/store/{phaseId}', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/task/update/{taskId}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/task/delete/{taskId}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('/task/subtask/create/{taskId}', [SubTaskController::class, 'create'])->name('subtasks.create');
    Route::get('/subtasks/edit/{subtaskId}', [SubTaskController::class, 'edit'])->name('subtasks.edit');
    Route::post('/task/subtask/{taskId}', [SubTaskController::class, 'store'])->name('subtasks.store');
    Route::put('/subtasks/update/{subtaskId}', [SubTaskController::class, 'update'])->name('subtasks.update');
    Route::delete('/subtasks/delete/{subtaskId}', [SubTaskController::class, 'destroy'])->name('subtasks.destroy');
    Route::patch('/subtasks/toggle/{subtask}',  [SubTaskController::class, 'toggleComplete'])->name('subtasks.toggleComplete');
});

require __DIR__ . '/auth.php';
