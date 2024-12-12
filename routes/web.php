<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalsController;
use App\Http\Controllers\ObjectivesController;

//For landing at the login page
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

//For landing at the register page
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

//For landing at the welcome page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');



################################################################# GOALS CONTROLLER #######################################################################    
// For adding up a new goal
Route::get('/add-goal', [GoalsController::class, 'addGoal'])->name('goals.add');

//For saving a new goal
Route::post('/save-goal', [GoalsController::class, 'saveGoal'])->name('goals.save');

//For viewing goals
Route::get('/view-goals', [GoalsController::class, 'viewGoals'])->name('view.goals');

//For updating the goal details
Route::put('/update-goals/{id}', [GoalsController::class, 'updateGoalDetails'])->name('goals.update');

//For deleting a goal
Route::delete('/goals/{id}', [GoalsController::class, 'deleteGoal'])->name('goals.delete');

################################################################# GOALS CONTROLLER #######################################################################    


################################################################# OBJECTIVES CONTROLLER #######################################################################
// For adding up a new objective
Route::get('/add-objective', [ObjectivesController::class, 'addObjective'])->name('objective.add');

//For saving an objective
Route::post('/save-objective', [ObjectivesController::class, 'saveObjective'])->name('objective.save');

//For updating an objective
Route::put('/update-objective/{objectiveId}', [ObjectivesController::class, 'updateObjective'])->name('goal.objective.update');

//For deleting an objective
Route::delete('/delete-objective/{objectiveId}', [ObjectivesController::class, 'deleteObjective'])->name('goal.objective.delete');

//For adding more objectives
Route::post('/add/{goalId}/objective', [ObjectivesController::class, 'addMoreObjective'])->name('objective.add.more');

################################################################# OBJECTIVES CONTROLLER #######################################################################   



















Route::get('/view-goal-objectives/{id}', [GoalsController::class, 'viewGoalObjectives'])->name('view.goal.objectives');





});
