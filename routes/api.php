<?php

use App\Http\Controllers\DispatchedJobController;
use App\Http\Controllers\ResidueController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', fn () => 'Plataforma Verde')->name('home');
Route::get('/residues', [ResidueController::class, 'index'])->name('residue.index');
Route::get('/residues/{id}', [ResidueController::class, 'show'])->name('residue.show');
Route::post('/residues', [ResidueController::class, 'store'])->name('residue.store');
Route::put('/residues/{id}', [ResidueController::class, 'update'])->name('residue.update');
Route::delete('/residues/{id}', [ResidueController::class, 'destroy'])->name('residue.delete');

Route::get('/dispatched/jobs/{id}', [DispatchedJobController::class, 'show'])->name('dispatched.job.show');
