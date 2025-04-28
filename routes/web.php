<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
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


Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');


    Route::prefix('sliders')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('admin.sliders.index');
        Route::get('/create', [SliderController::class, 'create'])->name('admin.sliders.create');
        Route::post('/store', [SliderController::class, 'store'])->name('admin.sliders.store');
        Route::get('/{slider}/edit', [SliderController::class, 'edit'])->name('admin.sliders.edit');
        Route::put('/{slider}', [SliderController::class, 'update'])->name('admin.sliders.update');
        Route::delete('/{slider}', [SliderController::class, 'destroy'])->name('admin.sliders.destroy');
    });
});