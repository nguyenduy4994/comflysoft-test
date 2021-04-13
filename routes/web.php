<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PointController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/point/{id}', [PointController::class, 'show'])->name('point.show');

Route::resource('/people', PeopleController::class)->names('people')->only(['index', 'create', 'store', 'edit', 'update']);
Route::prefix('/people/{personId}')->group(function () {
    Route::resource('/point', PointController::class)->names('point')->only(['index', 'store']);
});
