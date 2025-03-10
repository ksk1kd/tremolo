<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MergeController;
use App\Http\Controllers\HistoryController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::prefix('profile')->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/', 'edit')->name('profile.edit');
            Route::patch('/', 'update')->name('profile.update');
            Route::delete('/', 'destroy')->name('profile.destroy');
        });
    });

    Route::prefix('repository')->group(function () {
        Route::controller(RepositoryController::class)->group(function () {
            Route::get('/', 'index')->name('repository.index');
            Route::post('/', 'store')->name('repository.store');
            Route::get('/create', 'create')->name('repository.create');
            Route::delete('/{repository}', 'destroy')->name('repository.destroy');
            Route::get('/{repository}', 'show')->name('repository.show');
        });

        Route::controller(BranchController::class)->group(function () {
            Route::get('/{repository}/branch', 'index')->name('branch.index');
            Route::post('/{repository}/branch', 'store')->name('branch.store');
            Route::get('/{repository}/branch/create', 'create')->name('branch.create');
            Route::delete('/{repository}/branch/{branch}', 'destroy')->name('branch.destroy');
            Route::get('/{repository}/branch/{branch}', 'show')->name('branch.show');
        });

        Route::controller(FileController::class)->group(function () {
            Route::post('/{repository}/branch/{branch}/file', 'store')->name('file.store');
            Route::get('/{repository}/branch/{branch}/file/create', 'create')->name('file.create');
            Route::put('/{repository}/branch/{branch}/file', 'update')->name('file.update');
            Route::delete('/{repository}/branch/{branch}/file', 'destroy')->name('file.destroy');
            Route::get('/{repository}/branch/{branch}/file', 'show')->name('file.show');
            Route::get('/{repository}/file', 'master')->name('file.master');
            Route::get('/{repository}/branch/{branch}/file/edit', 'edit')->name('file.edit');
        });

        Route::controller(PageController::class)->group(function () {
            Route::get('/{repository}/branch/{branch}/page', 'show')->name('page.show');
            Route::get('/{repository}/page', 'master')->name('page.master');
        });

        Route::controller(MergeController::class)->group(function () {
            Route::post('{repository}/branch/{branch}/merge', 'store')->name('merge.store');
        });

        Route::controller(HistoryController::class)->group(function () {
            Route::get('/{repository}/history', 'index')->name('history.index');
        });
    });
});

require __DIR__ . '/auth.php';
