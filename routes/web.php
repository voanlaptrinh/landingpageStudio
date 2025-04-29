<?php

use App\Http\Controllers\Admin\CategoryVideoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\UploadController;
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
    Route::post('/upload-image', [UploadController::class, 'uploadImage'])->name('upload-image');
    Route::post('/delete-image', [UploadController::class, 'deleteImage'])->name('delete-image');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');


    Route::prefix('sliders')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('admin.sliders.index');
        Route::get('/create', [SliderController::class, 'create'])->name('admin.sliders.create');
        Route::post('/store', [SliderController::class, 'store'])->name('admin.sliders.store');
        Route::get('/{slider}/edit', [SliderController::class, 'edit'])->name('admin.sliders.edit');
        Route::put('/{slider}', [SliderController::class, 'update'])->name('admin.sliders.update');
        Route::delete('/{slider}', [SliderController::class, 'destroy'])->name('admin.sliders.destroy');
    });
    Route::prefix('/category-videos')->group(function () {
        Route::get('/', [CategoryVideoController::class, 'index'])->name('admin.category_videos.index');
        Route::get('/create', [CategoryVideoController::class, 'create'])->name('admin.category_videos.create');
        Route::post('/store', [CategoryVideoController::class, 'store'])->name('admin.category_videos.store');
        Route::get('/{slug}/edit', [CategoryVideoController::class, 'edit'])->name('admin.category_videos.edit');
        Route::put('/{slug}/update', [CategoryVideoController::class, 'update'])->name('admin.category_videos.update');
        Route::delete('/{slug}', [CategoryVideoController::class, 'destroy'])->name('admin.category_videos.destroy');
    });
    Route::prefix('/videos')->group(function () {
    Route::get('/', [VideoController::class, 'index'])->name('admin.videos.index');
    Route::get('/create', [VideoController::class, 'create'])->name('admin.videos.create');
    Route::post('/store', [VideoController::class, 'store'])->name('admin.videos.store');
    Route::get('videos/{slug}/edit', [VideoController::class, 'edit'])->name('admin.videos.edit');
    Route::put('videos/{slug}', [VideoController::class, 'update'])->name('admin.videos.update');
    Route::delete('videos/{slug}', [VideoController::class, 'destroy'])->name('admin.videos.destroy');
});
});