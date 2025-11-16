<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatabaseOperationsController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ModelOperationsController;
use App\Http\Controllers\WebPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test', function () {
//     return view('ornek');
// });

// Route::get('/test', [Ornek::class,'test']);

// Sample route showing parameter binding.
Route::get('/test/{name}', [ExampleController::class, 'show']);

// Landing page demo.
Route::get('/web', [WebPageController::class, 'showLandingPage'])->name('home');

// Simple form submission flow.
Route::get('/form', [FormController::class, 'showForm'])->name('form');

// Middleware-protected POST endpoint (rejects banned words).
Route::middleware('form.guard')->post('/form-result', [FormController::class, 'processSubmission'])->name('form.result');

// Query builder demonstrations.
Route::get('/add', [DatabaseOperationsController::class, 'insert']);
Route::get('/update', [DatabaseOperationsController::class, 'updateRecord']);
Route::get('/delete', [DatabaseOperationsController::class, 'delete']);
Route::get('/list', [DatabaseOperationsController::class, 'showRecords']);

// Eloquent model demonstrations.
Route::get('/model-list', [ModelOperationsController::class, 'listEntries']);
Route::get('/model-add', [ModelOperationsController::class, 'add']);
Route::get('/model-update', [ModelOperationsController::class, 'updateRecord']);
Route::get('/model-delete', [ModelOperationsController::class, 'delete']);
