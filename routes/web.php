<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\JobController;
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



Route::get('/home', [DocumentController::class, 'index'])->middleware(['auth'])->name('home');
Route::get('/home/{id}', [DocumentController::class, 'getDocument']);
Route::post('/add-document', [DocumentController::class, 'addDocument']);
Route::get('/delete-document/{id}', [DocumentController::class, 'deleteDocument']);
Route::post('/add-job', [JobController::class, 'addJob']);
Route::get('/delete-job/{id}', [JobController::class, 'deleteJob']);




require __DIR__.'/auth.php';