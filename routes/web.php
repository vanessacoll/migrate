<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MigrateController;

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

Route::get('/', [MigrateController::class, 'index']);

Route::post('/upload', [MigrateController::class, 'subirArchivo'])->name('upload.file');

Route::get('/migrar-conceptos', [MigrateController::class, 'migrarConceptos'])->name('migrar.conceptos');

Route::get('/clean-data', [MigrateController::class, 'cleanData'])->name('clean.data');
