<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ReportController;
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
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //grops
    Route::get('/groups/{group}/config', [GroupController::class, 'config'])->name('groups.config');

    Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');

    Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');

    Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');

    Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show');

    Route::get('/groups/{group}/edit', [GroupController::class, 'edit'])->name('groups.edit');

    Route::put('/groups/{group}', [GroupController::class, 'update'])->name('groups.update');

    Route::delete('/groups/{group}', [GroupController::class, 'destroy'])->name('groups.destroy');

    Route::post('/groups/{group}', [GroupController::class, 'addUser'])->name('groups.addUser');

    //filse
    Route::get('/files/index', [FileController::class, 'index'])->name('files.index');

    Route::get('/files/create', [FileController::class, 'create'])->name('files.create');

    Route::post('/files', [FileController::class, 'store'])->name('files.store');

    Route::get('/files/{file}', [FileController::class, 'show'])->name('files.show');

    Route::get('/files/{file}/edit', [FileController::class, 'edit'])->name('files.edit');

    Route::put('/files/{file}', [FileController::class, 'update'])->name('files.update');

    Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');

    Route::post('/files/bulk-update', [FileController::class, 'bulkUpdate'])->name('files.bulkUpdate');

    Route::post('/files/finish', [FileController::class, 'finishFile'])->name('files.finish');

    Route::post('/files/destroy', [FileController::class, 'destroy'])->name('files.destroy');

    //reprot

    Route::get('/groups/{group}/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/groups/{group}/reports/pdf', [ReportController::class, 'downloadPdf'])->name('reports.pdf');

});

require __DIR__ . '/auth.php';
